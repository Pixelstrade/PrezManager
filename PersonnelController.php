<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Personnel;
use Input;
use md5;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class PersonnelController extends Controller {


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
		//
        $personnels = Personnel::all();

        return view('personnel.list',compact('personnels'));

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('personnel.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//



        $personnel = new Personnel();

        $personnel->nom = Input::get('nom');
        $personnel->prenom =Input::get('prenom');
        $personnel->email =Input::get('email');
        $personnel->password = md5(Input::get('password'));
        $personnel->save();


        Session::flash('message', 'Successfully created personnel!');
        return Redirect::to('personnel');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $personnel = Personnel::find($id);
        return view('personnel.edit',compact('personnel'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $personnel = Personnel::find($id);
        if($personnel == null){
            return response()->json(['error' => 'Error'], 400);
        }
        $personnel->nom = Input::get('nom');
        $personnel->prenom =Input::get('prenom');
        $personnel->email =Input::get('email');
        if(Input::get('password') != "")
            $personnel->password = md5(Input::get('password'));
        $personnel->save();
        return Redirect::to('personnel/'.$id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $personnel = Personnel::find($id);
        if($personnel != null){
            $personnel->delete();
        }
        return Redirect::to('personnel');
	}

}
