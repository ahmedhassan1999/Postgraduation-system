<?php

namespace App\Models;
use App\Models\Registration;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personaldatastudent extends Model
{
    use HasFactory;
    protected $table='personaldatastudents';
    protected $guarded=[];
    protected $primaryKey  = 'idS';
    public function register()
    {
        return $this->hasMany(Registration::class,'idSF','idS');
    }
}
