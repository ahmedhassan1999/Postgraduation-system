<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referee extends Model
{
    use HasFactory;
    protected $table = 'referees';
    protected $guarded = [];
    protected $primaryKey  = 'idRefereed';
    public function register()
    {
        return $this->belongsToMany(Registration::class, 'reports', 'idRefereedF', 'idRegistrationF');
    }
    public function universtydegrees()
    {
        return $this->belongsTo(Universityposition::class, 'idDegreeF', 'idRefereed');
    }



}
