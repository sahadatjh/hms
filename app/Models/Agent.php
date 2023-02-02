<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'district_id',
        'address',
        'photo'
    ];

    public function getDistrict()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
}
