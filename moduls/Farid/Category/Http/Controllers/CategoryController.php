<?php


namespace Farid\Category\Http\Controllers;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Request;
use Farid\Category\Http\Requests\CategoryStoreRequest;
use Farid\Category\Models\Category;
use Farid\Category\Repositories\CategoryRepo;

class CategoryController extends Controller
{
    public $repo;

    public function __construct(CategoryRepo $categoryRepo)
    {
        $this->repo = $categoryRepo;
    }

    public function index(){
        $categories = $this->repo->all();
        return view('Category::index')->with(['categories' => $categories]);
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->repo->store($request);
        return back();

    }

    public function edit($categoryId){
        $categories = $this->repo->getAllExceptId($categoryId);
        $category = $this->repo->findById($categoryId);
        return view('Category::edit',compact('categories','category'));
    }

    public function update($categoryId,CategoryStoreRequest $request){

        $this->repo->update($categoryId,$request);
        return back();

    }

    public function destroy($categoryId){

        $this->repo->delete($categoryId);

        return response()->json([
            'message' => 'حذف موفقیت آمیز بود'
        ]);
    }

}
