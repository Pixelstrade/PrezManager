<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	//
    public $timestamps = false;

    public function Presentation(){
        return $this->belongsTo("app/Presentation");
    }

}
