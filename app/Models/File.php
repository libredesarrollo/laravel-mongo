<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

use MongoDB\Laravel\Eloquent\Model;

class File extends Model
{
    protected $primaryKey = '_id';

    protected $fillable = ['_id','name','file'];

    protected $collection = 'files_collection';

    

}
