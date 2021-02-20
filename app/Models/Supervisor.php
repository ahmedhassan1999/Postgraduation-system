<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    protected $table = 'supervisors';
    protected $guarded = [];
    protected $primaryKey  = 'idSupervisor';
    public function registrions()
    {
        return $this->belongsToMany(Registration::class, 'registerationsupervisors', 'idSupervisorF', 'idRegistrationF');
    }
    public function universtydegrees()
    {
        return $this->belongsTo(Universityposition::class, 'idDegreeF', 'idSupervisor');
    }
}
