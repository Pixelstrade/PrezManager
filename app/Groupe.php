<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Groupe extends Model {

	//


    public function personnels(){
        return $this->belongsToMany('App\Personnel');
    }
    public function presentations(){
        return $this->belongsToMany('App\Presentation');
    }
}
