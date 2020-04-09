<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timetracking extends Model
{
    //
	protected $table = 'timetracking';

	public $primaryKey = 'id';

      public $timestamps = false;

}
