<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $guarded = ['idDept']; //for the fillable
    protected $primaryKey = 'idDept';

    //every department may have many study type!
    public function studies()
    {
        return $this->hasMany(StudyType::class, 'idDeptF', 'idDept');
    }
}
