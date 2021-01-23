<?php

namespace App\Models;
use App\Models\Personaldatastudent;
use App\Models\Excuse;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table='registrations';
    protected $guarded=['idRegistration'];
    protected $primaryKey  ='idRegistration';
    public function personal()
    {
        return $this->belongsTo(Personaldatastudent::class,'idSF','idRegistration');
    }

    //every registration may have one excuse or more!
    public function excuses()
    {
        return $this->hasMany(Excuse::class, 'idRegistrationF', 'idRegistration');
    }
}
