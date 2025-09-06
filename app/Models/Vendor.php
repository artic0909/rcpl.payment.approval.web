<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_code',
        'vendor_code',
        'vendor_name',
        'vendor_category',
        'vendor_address',
        'vendor_account_number',
        'vendor_ifsc_code',
        'vendor_bank_name',
        'vendor_bank_branch_name',
        'contact_person_name',
        'contact_person_mobile',
        'contact_person_email',
        'related_product_service',
    ];

    // Automatically cast vendor_category to array
    protected $casts = [
        'vendor_category' => 'array',
    ];
}
