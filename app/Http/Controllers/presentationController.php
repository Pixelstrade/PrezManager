<?php namespace App\Http\Controllers;

use App\Groupe;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Personnel;
use App\Presentation;
use App\presentationsView;
use App\viewDelai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use DB;
use Session;
use ZipArchive;
use Illuminate\Support\Facades\Redirect;

class presentationController extends Controller {


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
        $presentations = Presentation::all();
        //return view("presentation.show",compact('presentations'));
        return view("presentation.tableview",compact('presentations'));
		//
	}

    /**
     * Display a tableview of the resource.
     *
     * @return Response
     */
    public function tableView()
    {
        $presentations = Presentation::all();
        return view("presentation.tableview",compact('presentations'));
        //
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return view('presentation.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//


        try {
            if(Input::file('zipfile') == null )
                return Redirect::to('presentation/create');

            $file = Input::file('zipfile');
            $filename = time() . Input::get('nom') . $file->getClientOriginalName();
            $file->move("uploads", $filename);


            $presentation = new Presentation;

            $zip = new ZipArchive;
            $res = $zip->open("uploads/" . $filename);
            if ($res === TRUE) {
                for ($i = 0; $i < $zip->numFiles && !strcmp($zip->getNameIndex($i), "thumb.jpg") == 0; $i++) ;
                if (strcmp($zip->getNameIndex($i), "thumb.jpg") == 0) {
                    $zip->extractTo('uploads/' . substr($filename, 0, -4) . "/", "thumb.jpg");
                    $presentation->ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
                }
            }


            $presentation->nom = Input::get('nom');
            $presentation->description = Input::get('description');
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->save();


            Session::flash('message', 'Successfully created presentation!');
            return Redirect::to('presentation/' . $presentation->id);

        } catch (Exception $e) {
            return Redirect::to('presentation/create');
        }


	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }
        $presentation->users->toArray();
        $presentation->groupes->toArray();

        $ids = array();
        foreach ($presentation->users as $u) {
            $ids[] = $u->id;
        }


        $ids2 = array();
        foreach ($presentation->groupes as $u) {
            $ids2[] = $u->id;
        }


        $views = DB::table('presentations_views')
            ->select('created_at', DB::raw('count(*) as total'))
            ->where("presentation_id",$id)
            ->groupBy('created_at')
            ->get();
        $questions = DB::table('questions')
            ->select('Question', 'response')
            ->where("presentation_id",$id)
            ->groupBy('Question','presentation_id')
            ->get();
        foreach($questions as $q){
            $q->reps = DB::table('questions')
                ->select('repindex', DB::raw('count(*) as total'))
                ->where("presentation_id",$id)
                ->where("Question",$q->Question)
                ->groupBy('repindex','Question','presentation_id')
                ->get();
        }


        $users = Personnel::whereNotIn('id',$ids)->get();
        $groupes = Groupe::whereNotIn('id',$ids2)->get();
        $delai = viewDelai::where("presentation_id",$id)->get();

        return view('presentation.single',compact('presentation','users','views','delai','groupes','questions'));
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

        $presentation = Presentation::find($id);
        return view('presentation.edit',compact('presentation'));
	}

    /**
     * Return the number of views
	 *
	 * @param  int  $id
	 * @return Response
     */
    public function views($id){
        $presentations = Presentation::all();
        $previw = array(count($presentations));


        for($i = 0;$i<count($presentations);$i++){
            $views = DB::table('presentations_views')
                ->select('created_at', DB::raw('count(*) as total'))
                ->where("presentation_id",$presentations[$i]->id)
                ->groupBy('created_at')
                ->get();

            $previw[$i] = array('nom'=>$presentations[$i]->nom,'views'=>$views);
        }

        return $previw;
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$presentation = Presentation::find($id);
        if($presentation == null){
            return response()->json(['error' => 'Error'], 400);
        }
        $presentation->nom = Input::get('nom');
        $presentation->description = Input::get('description');
        $presentation->save();
        return Redirect::to('presentation/'.$id);
	}

    /**
     * Update Zip of the presentation.
     *
     * @param  int  $id
     * @return Response
     */
    public function updateZip($id)
    {
        $presentation = Presentation::find($id);
        if($presentation == null){
            return response()->json(['error' => 'Error'], 400);
        }


        try {
            $file = Input::file('zipfile');
            $filename = time() . Input::get('nom') . $file->getClientOriginalName();
            $file->move("uploads", $filename);


            $zip = new ZipArchive;
            $res = $zip->open("uploads/" . $filename);
            if ($res === TRUE) {
                for ($i = 0; $i < $zip->numFiles && !strcmp($zip->getNameIndex($i), "thumb.jpg") == 0; $i++) ;
                if (strcmp($zip->getNameIndex($i), "thumb.jpg") == 0) {
                    $zip->extractTo('uploads/' . substr($filename, 0, -4) . "/", "thumb.jpg");
                    $presentation->ThumURI = 'uploads/' . substr($filename, 0, -4) . "/thumb.jpg";
                }
            }
            $presentation->ZipURI = "uploads/" . $filename;
            $presentation->version = $presentation->version + 1;
            $presentation->save();
            return response()->json(['upload' => 'success']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error'], 400);
        }
    }
    /**
     * Download Zip of the presentation.
     *
     * @param  int  $id
     * @return Response
     */
    public function downloadZip($id)
    {
        $file = Presentation::find($id)->ZipURI;
        return response()->download($file);
    }

    public function linkUser($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $users =Input::get('users');
        foreach($users as $u){
            $presentation->users()->attach($u);
        }
        return Redirect::to('presentation/'.$id);

    }


    public function linkGroupe($id){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $groupes =Input::get('groupes');
        foreach($groupes as $u){
            $presentation->groupes()->attach($u);
        }
        return Redirect::to('presentation/'.$id);

    }


    /**
     * Unlink between user and presentation
     *
     * @param $id
     * @param $uid
     * @return mixed
     */
    public function unlinkUser($id,$uid){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $presentation->users()->detach($uid);
        return Redirect::to('presentation/'.$id);
    }

    public function unlinkGroupe($id,$uid){
        $presentation = Presentation::find($id);
        if($presentation == null){
            return Redirect::to('presentation');
        }

        $presentation->groupes()->detach($uid);
        return Redirect::to('presentation/'.$id);
    }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $presentation = Presentation::find($id);
        if($presentation != null){
            $presentation->delete();
        }
        return Redirect::to('presentation');
	}

}
