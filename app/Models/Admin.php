<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $appends = ['full_name'];
    public function getFullNameAttribute() {
        return 'Administrator';
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function announcements() {
        return $this->hasMany(Announcement::class);
    }
}
