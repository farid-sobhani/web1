<?php
namespace Farid\Course\Http\Requests;

use Farid\Course\Models\Course;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }

    public function rules()
    {
        $rules = [
            "title" => 'required|min:3|max:190',
            "slug" => 'min:3|max:190',
            "time" => 'required|numeric',
            "number" => 'required|numeric',
            "season_id" => 'required|exists:seasons,id',
            "free" => 'required|boolean',
            "lesson_file" => 'required|mimes:avi,mkv,mp4,zip,rar'


        ];
        $update_rule =[];
        if (request()->method === 'PATCH') {
            $update_rule = [
                'lesson_file' => 'nullable|mimes:avi,mkv,mp4,zip,rar'
            ];
        }
        $rules = array_merge($rules,$update_rule);
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
