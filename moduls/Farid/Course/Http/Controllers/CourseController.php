<?php

namespace Farid\Course\Http\Controllers;

use App\Http\Controllers\Controller;
use Farid\Category\Repositories\CategoryRepo;
use Farid\Common\Responses\AjaxResponses;
use Farid\Course\Http\Requests\CourseRequest;
use Farid\Course\Repositories\CourseRepo;
use Farid\Media\Services\MediaFileService;
use Farid\Payment\Gateways\Gateway;
use Farid\Payment\Services\PaymentService;
use Farid\RolePermissions\Models\Permission;
use Farid\User\Repositories\UserRepo;
use Farid\Course\Models\Course;

class CourseController extends Controller
{
    public function index(CourseRepo $courseRepo)
    {
        $this->authorize('index', Course::class);
        if (auth()->user()->hasPermissionTo(Permission::PERMISSION_MANAGE_COURSES)) {
            $courses = $courseRepo->paginate();
        } else {
            $courses = $courseRepo->getCoursesByTeacherId(auth()->id());
        }
        return view('Courses::index', compact('courses'));
    }

    public function create(UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $this->authorize('index', Course::class);
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::create', compact('teachers', 'categories'));
    }

    public function store(CourseRequest $request, CourseRepo $courseRepo)
    {
        $request->request->add(['banner_id' => MediaFileService::upload($request->file('image'))]);
        $course = $courseRepo->store($request);

        return redirect()->route('courses.index');
    }

    public function destroy($id, CourseRepo $courseRepo)
    {

        $course = $courseRepo->findByid($id);
        $this->authorize('delete', $course);
        $courseRepo->delete($id);

    }

    public function edit($id, CourseRepo $courseRepo, UserRepo $userRepo, CategoryRepo $categoryRepo)
    {
        $course = $courseRepo->findById($id);
        $this->authorize('edit', $course);
        $teachers = $userRepo->getTeachers();
        $categories = $categoryRepo->all();
        return view('Courses::edit', compact('course', 'teachers', 'categories'));

    }

    public function update($id, CourseRequest $request, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $this->authorize('edit', $course);
        if ($request->hasFile('image')) {
            $request->request->add(['banner_id' => \Farid\Media\Services\MediaFileService::upload($request->file('image'))]);
            if ($course->banner)
                $course->banner->delete();
        } else {
            $request->request->add(['banner_id' => $course->banner_id]);
        }
        $courseRepo->update($id, $request);
        return redirect(route('courses.index'));

    }

    public function accept($id, CourseRepo $courseRepo)
    {

        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_ACCEPTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function reject($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateConfirmationStatus($id, Course::CONFIRMATION_STATUS_REJECTED)) {
            return AjaxResponses::SuccessResponse();
        }

        return AjaxResponses::FailedResponse();
    }

    public function lock($id, CourseRepo $courseRepo)
    {
        $this->authorize('change_confirmation_status', Course::class);
        if ($courseRepo->updateStatus($id, Course::STATUS_LOCKED)) {
            return AjaxResponses::SuccessResponse();
        }
        return AjaxResponses::FailedResponse();
    }

    public function details($id, CourseRepo $courseRepo)
    {
        $course = $courseRepo->findByid($id);
        $lessons = $course->lessons;


        return view('Courses::details', compact('course', 'lessons'));

    }

    public function buy($courseId, CourseRepo $courseRepo)
    {


        $course = $courseRepo->findById($courseId)->first();
        if (!$this->courseCanBePurchased($course)) {
            return back();
        }
        if ($course->confirmation_status != 'accepted') {
            return back();
        }
        if (auth()->user()->hasAccessToCourse($course)) {
            return back();
        }
        $invoice_id = PaymentService::generate($course->getFinalPrice(), $course, auth()->user());
        resolve(Gateway::class)->redirect($invoice_id);

    }

    private function courseCanBePurchased($course)
    {
        if ($course->type == 'free') {
            return false;
        }
        return true;
    }


}




