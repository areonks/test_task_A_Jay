<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Client extends Model
{
    use HasFactory;

    protected $withCount = ['users', 'activeUsers', 'inActiveUsers'];

    protected $fillable = [
        'client_name',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'phone_no1',
        'phone_no2',
        'zip',
        'longitude',
        'latitude',
        'start_validity',
        'end_validity',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scopeWithQueryParams(Builder $builder, $query)
    {
        $searchParams = array_key_exists('query', $query) ? $query['query'] : '';
        return $query['column'] ? $builder->where($query['column'], 'LIKE', "%$searchParams%") : $builder;
    }

    public function activeUsers()
    {
        return $this->users()->where('status', 'active');
    }

    public function inActiveUsers()
    {
        return $this->users()->where('status', 'inactive');
    }

    public function setAdditionalAttributes()
    {
        $cacheKey = $this->zip . $this->address1 . $this->address2;
        $geoData = Cache::rememberForever($cacheKey, function () {
            $geocode = \GoogleMaps::load('geocoding')
                ->setEndpoint('json')
                ->setParam(['address' => $this->address1 . $this->address2,
                    'components' => [
                        'administrative_area' => $this->state,
                        'country' => $this->country,
                        'city' => $this->city,
                    ]
                ])
                ->get();
            return json_decode($geocode)->results[0]->geometry->location;
        });
        $this->attributes= array_merge($this->attributes, [
                'latitude' => $geoData->lat,
                'longitude' => $geoData->lng,
                'start_validity' => Carbon::now(),
                'end_validity' => Carbon::now()->addDays(15)
            ]

        ) ;

    }
}
