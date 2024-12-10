<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;

    protected $appends = ['teacher_name', 'subject_name'];

    public function student() {
        return $this->belongsToMany(Student::class);
    }
    public function getTeacherNameAttribute() {
        return Teacher::find($this->teacher_id)->full_name;
    }
    public function getSubjectNameAttribute() {
        return Subject::find($this->subject_id)->name;
    }

}
