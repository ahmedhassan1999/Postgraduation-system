<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Previousstudie extends Model
{
    use HasFactory;
    protected $table = 'previousstudies';
    protected $guarded = [];
    public function personal()
    {

        return $this->belongsTo(Personaldatastudent::class, 'idSF');
    }
}
