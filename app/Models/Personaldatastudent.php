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
    public function registers()
    {
        return $this->hasMany(Registration::class, 'idSF', 'idS');
    }

    public function prevstudies()
    {

        return $this->hasMany(Previousstudie::class, 'idSF', 'idS');
    }
    public static function boot() {
        parent::boot();

        static::deleting(function($personaldatastudents) {
             $personaldatastudents->registers()->delete();
             $personaldatastudents->prevstudies()->delete();

        });
    }
}
