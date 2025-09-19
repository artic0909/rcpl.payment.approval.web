<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommercialRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'approval_status',
        'payment_status',
        'payment_type',
        'amount',
        'amount_in_words',
        'remarks',
        'reject_remarks',
    ];

     protected $casts = [
        'date' => 'date',
    ];
}
