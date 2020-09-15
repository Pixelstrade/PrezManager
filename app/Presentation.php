<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model {



	//
    protected $hidden = ['ZipURI'];
//
//    public function __construct(array $attributes = array()){
//        parent::__construct($attributes);
//        $this->users->toArray();
//    }

    /**
     * Get the user linked to this presentation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany('App\Personnel');
    }

    public function groupes(){
        return $this->belongsToMany('App\Groupe');
    }

    public function presentationsView(){
        return $this->belongsToMany('App\presentationsView');
    }

    public function viewDelais(){
        return $this->belongsToMany('App\viewDelai');
    }
}
