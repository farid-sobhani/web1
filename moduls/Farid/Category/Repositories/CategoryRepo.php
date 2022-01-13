<?php


namespace Farid\Category\Repositories;


use Farid\Category\Models\Category;

class CategoryRepo
{
    public function all()
    {
        return Category::all();

    }

    public function store($category)
    {
       return Category::create([
            'title' => $category->title,
            'slug' => $category->slug,
            'parent_id' => $category->parent_id
        ]);

    }

    public function getAllExceptId($id)
    {
       return Category::where('id','!=',$id)->get();

    }

    public function update($id,$values)
    {
        return Category::where('id',$id)->update([
            'title' => $values->title,
            'slug' => $values->slug,
            'parent_id' => $values->parent_id
        ]);
    }
    public function delete($id){
        return Category::find($id)->delete();
    }
    public function findById($id){
        return Category::find($id);
    }

}
