<?php

namespace App\Models\Categories;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    const UPDATED_AT = null;
    const CREATED_AT = null;
    protected $fillable = [
        'main_category_id',
        'sub_category',
    ];
    public function mainCategory(){
        return $this->belongsTo('App\Models\Categories\MainCategory');
    }

    public function posts(){
        // postsテーブルとの多対多リレーションの定義
         return $this->belongsToMany('App\Models\Categories\SubCategory', 'post_sub_categories','sub_category_id', 'post_id');
    }
}
