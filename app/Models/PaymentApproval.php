<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentApproval extends Model
{
    use HasFactory;

    protected $table = 'payment_approvals';

    protected $fillable = [
        'status',
        'payment_status',
        'remarks',
        'user_id',
        'date',
        'request_for',
        'vendor_name',
        'vendor_code',
        'site_name',
        'amount',
        'amount_in_words',
        'item_description',
        'party_account_number',
        'party_ifsc_code',
        'party_bank_name',
        'party_bank_branch_name',
    ];

    // request_for is JSON, so cast it to array automatically
    protected $casts = [
        'request_for' => 'array',
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    /**
     * Relationship: PaymentApproval belongs to a User/Staff
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
