<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    public function teachers() {
        return $this->belongsToMany(
            Teacher::class
        );
    }
    public function students() {
        return $this->belongsToMany(Student::class);
    }
}
