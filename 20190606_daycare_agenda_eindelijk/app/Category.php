<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';

    public $primaryKey = 'id';

    public $timestamps = false;




    public function cell()
    {
       //return $this->belongsTo('App\Cell');
    	return $this->hasOne(Cell::class);
    }
}
