<?php

namespace App\Models;

use App\Models\Registration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaldatastudent extends Model
{
    use HasFactory;
    protected $table = 'personaldatastudents';
    protected $guarded = ['idS'];
    protected $primaryKey  = 'idS';
    public function register()
    {
        return $this->hasMany(Registration::class, 'idSF', 'idS');
    }
    public function prevstudies()
    {

        return $this->hasMany(Previousstudie::class, 'idSF', 'idS');
    }
}
