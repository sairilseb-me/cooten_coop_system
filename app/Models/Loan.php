<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'applicant_id',
        'loan_type_id',
        'loan_request_status',
        'approved_by',
        'payment_status',
        'loan_amount',
        'date_applied',
        'date_approved',
        'date_released',
        'reason',
        'remarks',
    ];

    public function loan_type()
    {
        return $this->hasOne(LoanType::class, 'id', 'loan_type_id');
    }
}
