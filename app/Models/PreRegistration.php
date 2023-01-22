<?php

namespace App\Models;

use Database\Factories\HajjiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreRegistration extends Model
{
    use HasFactory;

    protected $table = 'hajjis';

    protected $fillable = [
        'pre_registrations',
        'name',
        'fathers_name',
        'mothers_name',
        'spouse_name',
        'occupation',
        'mobile',
        'nid',
        'ng',
        'tracking_number',
        'dob',
        'district_id',
        'districts',
        'district',
        'gender',
        'package_id',
        'address',
        'remarks',
        'photo',
        'pid',
        'passport_no',
        'passport_image',
        'pre_registrations'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }	
}
