<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Groupe;
use App\Personnel;
use Illuminate\Http\Request;

use Input;
use Session;
use Illuminate\Support\Facades\Redirect;
class GroupeController extends Controller {



    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $groupes = Groupe::all();
        foreach ($groupes as $g) {
            $g->personnels->toArray();
        }
        return view('groupe.liste',compact("groupes"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('groupe.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $groupe= new Groupe();

        $groupe->nom = Input::get('nom');
        $groupe->description = Input::get('description');
        $groupe->save();

        Session::flash('message', 'Successfully created groupe!');
        return Redirect::to('groupe'.$groupe->$id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$groupe = Groupe::find($id);
        $groupe->personnels->toArray();
        $ids = array();
        foreach ($groupe->personnels as $u) {
            $ids[] = $u->id;
        }
        $users = Personnel::whereNotIn('id',$ids)->get();



        if($groupe)
            return view('groupe.single',compact("groupe","users"));
        return Redirect::to('groupe');

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $groupe = Groupe::find($id);
        if($groupe != null){
            $groupe->delete();
        }
        return Redirect::to('groupe');
	}


    public function linkUser($id){
        $groupe = Groupe::find($id);
        if($groupe == null){
            return Redirect::to('groupe');
        }

        $users =Input::get('users');
        foreach($users as $u){
            $groupe->personnels()->attach($u);
        }
        return Redirect::to('groupe/'.$id);

    }

    /**
     * Unlink between user and presentation
     *
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function unlinkUser($id,$uid){
        $groupe = Groupe::find($id);
        if($groupe == null){
            return Redirect::to('groupe');
        }

        $groupe->personnels()->detach($uid);
        return Redirect::to('groupe/'.$id);
    }

}
