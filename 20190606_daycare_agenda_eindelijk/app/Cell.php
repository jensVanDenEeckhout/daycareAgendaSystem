<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;
use App\Category;
use App\Floor;

class Cell extends Model
{
    //
    protected $table = 'cells';

    public $primaryKey = 'id';

    public $timestamps = false;




    public function task(){
    	//return $this->hasOne('App\Tasks');
    	return $this->belongsTo(Task::class);
    }
    
    public function client(){
    	//return $this->hasOne('App\Tasks');
    	return $this->belongsTo(Client::class);
    }

    public function floor(){
        //return $this->hasOne('App\Tasks');
        return $this->belongsTo(Floor::class);
    }

    public function category(){
        //return $this->hasOne('App\Tasks');
        return $this->belongsTo(Category::class);
    }    
}
