<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Announcement;
use App\Models\Course;
use App\Models\Student;
use App\Models\StudentClass;
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

        Subject::factory(6)->create();

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
            $teacher->addSubject($subjects[\rand(0, count($subjects) - 1)]);
            $teacher->user->update([
                'access_type' => 'teacher'
            ]);
        }


        $it = Course::create([
            'name' => 'BSIT'
        ]);

        $student = User::factory()->create([
            'email' => 'student@mail.com',
            'password' => '123',
            'access_type' => 'student'
        ]);
        $class1 = StudentClass::factory()->create([
            'name' => 'BSIT 3-2'
        ]);
        Student::factory()->create([
            'user_id' => $student->id,
            'first_name' => 'Nico Bernard',
            'last_name' => 'Firmanes',
            'middle_name' => 'Banares',
            'year' => 3,
            'block' => 2,
            'course_id' => $it->id,
            'class_id' => $class1->id,
        ]);
        $is = Course::create(['name' => 'BSIS']);
        $ais = Course::create(['name' => 'BSAIS']);
        $cs = Course::create(['name' => 'BSCS']);
        $a = Course::create(['name' => 'BSA']);
        // course_id class_id
        for ($i = 0; $i < 30; $i++) {
            for ($year = 1; $year <= 4; $year++) {
                for ($block = 1; $block <= 4; $block++) {
                    $itClass = StudentClass::addClass("{$it->name} {$year}-{$block}");
                    Student::factory()->create([
                        'course_id' => $it->id,
                        'class_id' => $itClass->id
                    ]);

                    $isClass = StudentClass::addClass("{$is->name} {$year}-{$block}");
                    Student::factory()->create([
                        'course_id' => $is->id,
                        'class_id' => $isClass->id
                    ]);

                    $aisClass = StudentClass::addClass("{$ais->name} {$year}-{$block}");
                    Student::factory()->create([
                        'course_id' => $ais->id,
                        'class_id' => $aisClass->id
                    ]);

                    $csClass = StudentClass::addClass("{$cs->name} {$year}-{$block}");
                    Student::factory()->create([
                        'course_id' => $cs->id,
                        'class_id' => $csClass->id
                    ]);

                    $aClass = StudentClass::addClass("{$a->name} {$year}-{$block}");
                    Student::factory()->create([
                        'course_id' => $cs->id,
                        'class_id' => $aClass->id
                    ]);
                }
            }
        }

    }
}
