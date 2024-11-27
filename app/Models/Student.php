<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    public function grades() {
        return $this->belongsToMany(Grade::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function teachers() {
        return $this->belongsToMany(Teacher::class);
    }

}
