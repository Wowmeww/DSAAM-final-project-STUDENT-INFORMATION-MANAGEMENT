<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Teacher extends Model
{
    /** @use HasFactory<\Database\Factories\TeacherFactory> */
    use HasFactory;

    protected $appends = ['full_name'];
    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->middle_name[0]}";
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(
            Subject::class
        );
    }
    public function getEmailAttribute()
    {
        return $this->user->email;
    }
    public function addSubject($id)
    {
        $this->subjects()->attach($id);
    }
    public function removeAllSubjects()
    {
        $this->subjects()->detach($this->subjects);
    }
    public function enrolledClasses()
    {
        return $this->hasMany(TeacherEnrolledClass::class);
    }
    public function enrollClass($class_id, $subject_id)
    {
        $class = $this->enrolledClasses()->firstOrCreate([
            'teacher_id' => $this->id,
            'class_id' => $class_id,
            'subject_id' => $subject_id,
        ]);
        return $class;
    }



}
