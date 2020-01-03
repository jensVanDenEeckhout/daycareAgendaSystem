<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cell;

class Task extends Model
{
    //    
    protected $table = 'tasks';

    public $primaryKey = 'id';

    public $timestamps = false;


    public function cell()
    {
       //return $this->belongsTo('App\Cell');
    	return $this->hasOne(Cell::class);
    }
    
}

