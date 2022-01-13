<?php

namespace Farid\Course\Tests\Feature;

use Farid\Category\Models\Category;
use Farid\Course\Database\Seeds\RolePermissionTableSeeder;
use Farid\Course\Models\Lesson;
use Farid\Course\Models\Season;
use Farid\Course\Models\Course;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class LessonTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    public function test_permitted_user_can_see_creation_page(){
        $this->actAsAdmin();
        $course = $this->createCourse();
        $this->get(route('lessons.create',[$course->id]))->assertOk();
    }

    private function createUser()
    {
        $this->actingAs(factory(User::class)->create());

        $this->seed(RolePermissionTableSeeder::class);
    }

    private function actAsUser()
    {
        $this->createUser();
    }

    private function actAsAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    private function actionAsSuperAdmin()
    {
        $this->createUser();
        auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_COURSES);
    }

    private function createLesson($course){
        return Lesson::create([
            "title" => "lesson one",
            "slug" => "lesson one",
            "course_id" => $course->id,
            "user_id" => auth()->id(),
        ]);
    }
    private function createCourse()
    {
        $data = $this->courseData() + ['confirmation_status' => Course::CONFIRMATION_STATUS_PENDING,];
        unset($data['image']);
        return Course::create($data);
    }

    private function createCategory()
    {
        return Category::create(['title' => $this->faker->word, "slug" => $this->faker->word]);
    }

    private function courseData()
    {
        $category = $this->createCategory();
        return[
            'title' => $this->faker->sentence(2),
            "slug" => $this->faker->sentence(2),
            'teacher_id' => auth()->id(),
            'category_id' => $category->id,
            "priority" => 12,
            "price" => 1200,
            "percent" => 70,
            "type" => Course::TYPE_FREE,
            "image" => UploadedFile::fake()->image('banner.jpg'),
            "status" => Course::STATUS_COMPLETED,
        ];
    }



}
