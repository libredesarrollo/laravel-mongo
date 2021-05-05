<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;

class File extends Model
{
    protected $primaryKey = '_id';

    protected $fillable = ['_id','name','file'];

    protected $collection = 'files_collection';

    

}
