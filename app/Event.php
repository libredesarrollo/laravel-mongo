<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Event extends Model
{
    protected $primaryKey = '_id';
    protected $fillable = ['_id','title','content', 'text_color','color_bg','start','end','allday', 'files'];

    protected $collection = 'events_collection';

    protected $dates = ['created_at', 'updated_at', 'start', 'end'];

    protected $appends = ['textColor','color','id', 'allDay'];

    protected $hidden = ['color_bg','text_color','_id','allday'];
    
    public function get_idAttribute(){
        return $this->attributes['_id'];
    }

    public function getTextColorAttribute(){
        return $this->attributes['text_color'];
    }
    public function getAllDayAttribute(){
        return $this->attributes['allday'];
    }

    public function getColorAttribute(){
        return $this->attributes['color_bg'];
    }

    public function getStartAttribute(){
        return $this->asDateTime($this->attributes['start'])->format("Y-m-d\TH:i:s");
    }

    public function getEndAttribute(){
        return $this->asDateTime($this->attributes['end'])->format("Y-m-d\TH:i:s");
    }

    //public function files(){
        //return $this->hasOne(Category::class);
        //return $this->belongsToMany(File::class);
        //return $this->embedsMany(File::class);
   // }

}
