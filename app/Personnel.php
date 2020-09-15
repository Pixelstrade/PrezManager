<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Personnel extends Model implements AuthenticatableContract{

    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'personnels';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nom','prenom','email', 'password'];


    /**
     * Get the presentation linked to this personnel
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function presentations(){
        return $this->belongsToMany('App\Presentation');
    }

    public function groupes(){
        return $this->belongsToMany('App\Groupe');
    }
}
