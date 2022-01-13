<?php

namespace Farid\Course\Http\Controllers;

use Farid\Course\Http\Requests\SeasonRequest;
use Farid\Course\Repositories\SeasonRepo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SeasonController extends Controller
{
    public function store($course, SeasonRequest $request, SeasonRepo $seasonRepo)
    {
        $seasonRepo->store($course, $request);



        return back();
    }
}
