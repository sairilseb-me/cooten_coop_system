<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'loan_types';
    protected $primarykey = 'id';
    protected $fillable = ['name'];
}
