<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public function grades() {
        return $this->belongsToMany(Grade::class);
    }

    public function  getCourseAttribute() {
        $course = Course::find($this->course_id);
        return $course->name;
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
