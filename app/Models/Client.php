<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

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

    public function activeUsers()
    {
        return $this->users()->where('status', 'active');
    }

    public function inActiveUsers()
    {
        return $this->users()->where('status', 'inactive');
    }
}
