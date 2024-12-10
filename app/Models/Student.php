<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $appends = ['course', 'full_name', 'class_name'];

    public function grades() {
        return $this->hasMany(Grade::class, 'student_id');
    }
    public function addGrade($grade, $subject_id, $teacher_id) {
        Grade::updateOrInsert([
            'student_id' => $this->id,
            'grade' => $grade,
            'subject_id' => $subject_id,
            'teacher_id' => $teacher_id,
        ]);
    }

    public function class() {
        return $this->belongsTo(StudentClass::class);
    }
    public function  getCourseAttribute() {
        $course = Course::find($this->course_id);
        return $course->name;
    }
    public function  getClassNameAttribute() {
        $course = $this->course;
        $block = $this->block;
        $year = $this->year;
        return "{$course} {$year} - {$block}";
    }
    public function  getFullNameAttribute() {
        return "{$this->last_name} {$this->first_name} {$this->middle_name[0]}.";
    }
    public function  getEmailAttribute() {
        return $this->user->email;
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function teachers() {
        return $this->belongsToMany(Teacher::class);
    }

}
