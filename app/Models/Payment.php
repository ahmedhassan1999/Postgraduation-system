<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded = ['idPayment'];//all data are fillable except for the (id) of the table
    protected $primaryKey = 'idPayment';
}
