<?php

namespace App\Models;
use App\Models\Personaldatastudent;
use App\Models\Excuse;
use App\Models\Course;

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

    //every registration may have one payment or more!
    public function payments()
    {
        return $this->hasMany(Payment::class, 'idRegistrationF', 'idRegistration');
    }

    //every registration may have one remark(state) or more!
    public function states()
    {
        return $this->hasMany(State::class, 'idRegistrationF', 'idRegistration');
    }

    //many to many relationship with courses model!
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'results', 'idRegistrationF', 'idCourseF');
    }
}
