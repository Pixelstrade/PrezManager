<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class viewDelai extends Model {

	//
    public $timestamps = false;
    //

    public function Presentation(){
        return $this->belongsTo("app/Presentation");
    }

}
