<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    /** @use HasFactory<\Database\Factories\StudentClassFactory> */
    use HasFactory;

    protected $appends = ['population'];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
    public function getPopulationAttribute()
    {
        return count($this->students);
    }
    public static function addClass($class_name)
    {
        $id = StudentClass::firstOrCreate([
            'name' => $class_name
        ]);
        return $id;
    }
    public function enrolledClass()
    {
        return $this->belongsTo(TeacherEnrolledClass::class);
    }

}
