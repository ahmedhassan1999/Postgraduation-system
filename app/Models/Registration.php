<?php

namespace App\Models;
use App\Models\Personaldatastudent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $table=['registrations'];
    protected $guarded=[];
    protected $primaryKey  ='idRegistration';
    public function personal()
    {
        return $this->belongsTo(Personaldatastudent::class,'idSF','idRegistration');
    }

}
