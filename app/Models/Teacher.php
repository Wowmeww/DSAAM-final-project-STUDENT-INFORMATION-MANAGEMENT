<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, foreignPivotKey: 'subject_id', relatedKey: 'name');
    }
    public function addSubject($subject_id)
    {
        $this->subjects()->attach($subject_id, [
            'teacher_id' => $this->id,
            'subject_id' => $subject_id
        ]);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
