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
        'district',
        'gender',
        'package_id',
        'price',
        'discount',
        'is_percent',
        'address',
        'remarks',
        'photo',
        'pid',
        'passport_no',
        'passport_image',
        'visa_number',
        'visa_image',
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

    public function get_district()
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
