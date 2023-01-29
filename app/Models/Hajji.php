<?php

namespace App\Models;

use Database\Factories\HajjiFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hajji extends Model
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
        'pre_registrations',
        'status'
    ];

    public static $rules = [
        'name'        => 'required|max:255',
        'occupation'  => 'required',
        'mobile'      => 'required',
        'nid'         => 'required|numeric',
        'dob'         => 'required',
        'district_id' => 'required',
        'gender'      => 'required',
        'address'     => 'required',
        'package_id'  => 'required',
    ];

    public function district()
    {
        return $this->belongsTo(District::class,'district_id','id');
    }
    
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
    
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
