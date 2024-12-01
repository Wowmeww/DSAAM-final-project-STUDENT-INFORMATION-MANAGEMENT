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
        return $this->belongsToMany(
            Subject::class,
        );
    }
    public function getEmailAttribute()
    {
        return $this->user->email;
    }
    public function getNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->middle_name[0]}.";
    }
    public function addSubject($id)
    {
        $this->subjects()->attach($id);
    }
    public function removeAllSubjects()
    {
        $this->subjects()->detach($this->subjects);
    }
    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
}
