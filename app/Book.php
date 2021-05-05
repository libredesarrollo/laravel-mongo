<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = '_id';

    protected $fillable = ['_id','title','description','age', 'category_id','classification','type','price']; //'category'

    protected $collection = 'books_collection';

    public function category(){
        //return $this->hasOne(Category::class);
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        //return $this->hasOne(Category::class);
        return $this->belongsToMany(Tag::class);
    }

}
