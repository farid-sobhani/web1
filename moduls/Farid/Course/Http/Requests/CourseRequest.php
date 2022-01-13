<?php
namespace Farid\Course\Http\Requests;

use Farid\Course\Models\Course;
use Farid\Course\Rules\ValidTeacher;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CourseRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            "title" => 'required|min:3|max:190',
            "slug" => 'required|min:3|max:190|unique:courses,slug',
            "priority" => 'nullable|numeric',
            "price" => 'required|numeric|min:0|max:10000000',
            "percent" => 'required|numeric|min:0|max:100',
            "teacher_id" => ['required','exists:users,id', new \Farid\Course\Rules\ValidTeacher()],
            "type" => ["required", Rule::in(\Farid\Course\Models\Course::$types)],
            "status" => ["required", Rule::in(Course::$statuses)],
            "category_id" => "required|exists:categories,id",
            "image" => "required|mimes:jpg,png,jpeg",
        ];

        if (request()->method === 'PATCH') {
            $rules['image'] = "nullable|mimes:jpg,png,jpeg";
            $rules['slug'] = 'required|min:3|max:190|unique:courses,slug,' . request()->route('course');
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            "price" => "قیمت",
            "slug" => "عنوان انگلیسی",
            "priority" => "ردیف دوره",
            "percent" => "درصد مدرس",
            "teacher_id" => "مدرس",
            "category_id" => "دسته بندی",
            "status" => "وضعیت",
            "type" => "نوع",
            "body" => "توضیحات",
            "image" => "بنر دوره",
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
