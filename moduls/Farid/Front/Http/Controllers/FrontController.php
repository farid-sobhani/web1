<?php
namespace Farid\Front\Http\Controllers;

use Farid\Category\Models\Category;
use Farid\Course\Models\Course;
use Farid\Course\Repositories\CourseRepo;
use Farid\Course\Repositories\LessonRepo;

class FrontController extends \App\Http\Controllers\Controller
{
    public function index(CourseRepo $courseRepo)
    {
        $categories = Category::all();
        $latestCourses = $courseRepo->getLatestCourses();
        $popularCourses = $courseRepo->getPopularCourses();
        return view('Front::index',compact('categories','latestCourses','popularCourses'));
    }

    public function singleCourse($courseId,$lessonId = '1' , CourseRepo $courseRepo, LessonRepo $lessonRepo)
    {

        $categories = Category::all();
        $course = $courseRepo->findById($courseId)->first();

        $lesson = $course->lessons;



        $register = false;
        if (auth()->user()) {
            $register = $courseRepo->userHasRegistered(auth()->user()->id,$course);
        }

        return view('Front::course.course',compact('categories','course','register','lesson'));
    }


}
