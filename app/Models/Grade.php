<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    /** @use HasFactory<\Database\Factories\GradeFactory> */
    use HasFactory;

    public function student() {
        return $this->belongsToMany(Student::class);
    }
    public function subject() {
        return $this->belongsToMany(Course::class);
    }
    public function teacher() {
        return $this->belongsToMany(Teacher::class);
    }
}
