<?php


namespace Farid\Category\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    protected $primaryKey='id';

    public function getParentAttribute()
    {
       // return (is_null($this->parent_id)) ? 'ندارد' : $this->parentCategory->title;
        return $this->parent_id;

    }

    public function parentCategory(){
        $this->belongsTo(Category::class,'parent_id');
    }

    public function subCategory(){
        return $this->hasMany(Category::class,'parent_id');
    }


}
