<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Floor;

class Client extends Model
{
    protected $table = 'clients';

    public $primaryKey = 'id';

    public $timestamps = false;




    public function cell()
    {
       //return $this->belongsTo('App\Cell');
    	return $this->hasOne(Cell::class);
    }

    public function floor(){
        //return $this->hasOne('App\Tasks');
        return $this->belongsTo(Floor::class);
    }

}
