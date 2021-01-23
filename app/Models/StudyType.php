<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudyType extends Model
{
    use HasFactory;
    protected $table = 'studytypes';
    protected $guarded = ['idStudyType']; //for the fillable
    protected $primaryKey = 'idStudyType';

    public function registrations()
    {
        return $this->hasMany(Registration::calss, 'idStudyTypeF', 'idStudyType');
    }

    public function courses()
    {
        return $this->hasMany(Course::calss, 'idStudyTypeF', 'idStudyType');
    }
}
