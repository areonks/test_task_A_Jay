<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function scopeWithQuseryParams(Builder $builder, $query)
    {
        return $query['colum'] ? $builder->where($query['colum'], 'LIKE', "%$query[query]%") : $builder;
    }

    public function activeUsers()
    {
        return $this->users()->where('status', 'active');
    }

    public function inActiveUsers()
    {
        return $this->users()->where('status', 'inactive');
    }
}
