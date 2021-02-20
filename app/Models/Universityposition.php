<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universityposition extends Model
{
    use HasFactory;
    protected $table = 'universitypositions';
    protected $guarded = [];
    protected $primaryKey  = 'idUniversityPosition';
    public function refrees()
    {
        return $this->hasMany(Referee::class, 'idDegreeF', 'idUniversityPosition');
    }
    public function supervisors()
    {
        return $this->hasMany(Supervisor::class, 'idDegreeF', 'idUniversityPosition');
    }
}
