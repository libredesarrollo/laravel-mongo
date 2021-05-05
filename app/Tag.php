<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class Tag extends Model
{
    protected $primaryKey = '_id';

    protected $fillable = ['_id','title'];

    protected $collection = 'tags_collection';

    public function books(){
        return $this->belongsToMany(Book::class);
    }
}
