<?php

namespace Farid\Course\Repositories;


use Farid\Course\Models\Course;
use Farid\Course\Models\Lesson;
use Farid\Course\Models\Season;
use Illuminate\Support\Str;
use Farid\Media\Models\Media;

class LessonRepo
{
    public function store($courseId, $values)
    {
        return Lesson::create([
            'title' => $values->title,
            'slug' => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            'time' => $values->time,
            'number' => $values->number,
            'season_id' => $values->season_id,
            'course_id' => $courseId,
            'free' => $values->free,
            'media_id' => $values->media_id,
            'desc' => $values->desc,
        ]);
    }

    public function paginate()
    {
        return Lesson::paginate();
    }

    public function findByid($id)
    {
        return Lesson::findOrFail($id);
    }

    public function update($id, $courseId, $values)
    {
        return Lesson::where('id', $id)->update([
            "title" => $values->title,
            "slug" => $values->slug ? Str::slug($values->slug) : Str::slug($values->title),
            "time" => $values->time,
            "number" => $values->number,
            'season_id' => $values->season_id,
            'media_id' => $values->media_id,
            'desc' => $values->desc,
            "free" => $values->free
        ]);
    }

    public function updateConfirmationStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['confirmation_status'=> $status]);
    }

    public function updateStatus($id, string $status)
    {
        return Course::where('id', $id)->update(['status'=> $status]);
    }

    public function getCourseSeasons($course)
    {

        return $course->seasons;
    }

    public function findByCourseId($courseId)
    {
        return Lesson::where('course_id',$courseId)->get();
    }
}
