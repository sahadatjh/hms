<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'hajji_id',
        'payment_date',
        'payment_method',
        'bank_name',
        'branch_name',
        'check_no',
        'issue_date',
        'deposite_no',
        'amount',
        'is_online_transfer',
        'remarks',
        'created_by'
    ];
}
