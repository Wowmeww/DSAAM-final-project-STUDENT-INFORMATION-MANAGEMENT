<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@mail.com',
            'password' => '123',
            'access_type' => 'admin'
        ]);
        Admin::create([
            'user_id' => $admin->id
        ]);
        Announcement::factory(15)->create();
        $bsit = Course::create([
            'name' => 'BSIT'
        ]);
        Course::create(['name' => 'BSIS']);
        Course::create(['name' => 'BSAIS']);
        Course::create(['name' => 'BSCS']);
        Course::create(['name' => 'BSA']);

        Subject::factory(6)->create();

        $student = User::factory()->create([
            'email' => 'student@mail.com',
            'password' => '123',
            'access_type' => 'student'
        ]);
        Student::factory()->create([
            'user_id' => $student->id,
            'first_name' => 'Nico Bernard',
            'last_name' => 'Firmanes',
            'middle_name' => 'Banares',
            'year' => 3,
            'block' => 2,
            'course_id' => $bsit->id
        ]);

        $teacher = User::factory()->create([
            'email' => 'teacher@mail.com',
            'password' => '123',
            'access_type' => 'teacher'
        ]);
        Teacher::factory()->create([
            'user_id' => $teacher->id,
            'first_name' => 'Ken',
            'last_name' => 'Gis',
            'middle_name' => 'K',
        ]);

        $subjects = Subject::all();
        $teacher->owner->addSubject($subjects[0]->id);
        $teacher->owner->addSubject($subjects[1]->id);

        for ($i = 1; $i <= 30; $i++) {
            $teacher = Teacher::factory()->create();
            $teacher->addSubject($subjects[\rand(0, count($subjects)-1)]);
            $teacher->user->update([
                'access_type' => 'teacher'
            ]);
        }
        for ($i = 1; $i <= 4; $i++) {
            for ($j = 1; $j <= 30; $j++) {
                Student::factory()->create([
                    'year' => $i,
                    'block' => 1,
                    'course_id' => Course::all()[$i - 1]->id
                ])->user->update([
                        'access_type' => 'student'
                    ]);
                Student::factory()->create([
                    'year' => $i,
                    'block' => 2,
                    'course_id' => Course::all()[$i - 1]->id
                ])->user->update([
                        'access_type' => 'student'
                    ]);
                Student::factory()->create([
                    'year' => $i,
                    'block' => 3,
                    'course_id' => Course::all()[$i - 1]->id
                ])->user->update([
                        'access_type' => 'student'
                    ]);
                Student::factory()->create([
                    'year' => $i,
                    'block' => 4,
                    'course_id' => Course::all()[$i]->id
                ])->user->update([
                        'access_type' => 'student'
                    ]);
            }
        }

    }
}
