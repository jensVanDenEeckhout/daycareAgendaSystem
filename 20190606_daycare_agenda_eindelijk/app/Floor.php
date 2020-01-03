<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    //
    protected $table = 'floors';

    public $primaryKey = 'id';

    public $timestamps = false;




    public function cell()
    {
       //return $this->belongsTo('App\Cell');
    	return $this->hasOne(Cell::class);
    }
    public function client()
    {
       //return $this->belongsTo('App\Cell');
    	return $this->hasOne(Client::class);
    }    
}
