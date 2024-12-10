<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherEnrolledClass extends Model
{
    protected $appends = ['subject_name', 'class_name', 'population'];
    public function teachers() {
        return $this->hasMany(Teacher::class);
    }
    public function class() {
        return $this->hasOne(StudentClass::class, 'id');
    }
    public function subjects() {
        return $this->hasMany(Subject::class);
    }
    public function getSubjectNameAttribute() {
        return Subject::find($this->subject_id)->name;
    }
    public function getClassNameAttribute() {
        return StudentClass::find($this->class_id)->name;
    }
    public function getPopulationAttribute() {
        return StudentClass::find($this->subject_id)->population ?? null;
    }
}
