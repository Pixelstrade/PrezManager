<?php namespace App\Http\Controllers;

use DB;
use App\Presentation;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $presentations = Presentation::all();
        $previw = array(count($presentations));
        $totalviews = DB::table('presentations_views')
            ->select(DB::raw('count(*) as total'))
            ->get();
        $totalviewsweek = DB::table('presentations_views')
            ->select(DB::raw('count(*) as total'))
            ->whereRaw("created_at > '".date("Y-m-d",strtotime('this week', time()))."'")
            ->get();
        $toppresentation= Presentation::find(DB::table('presentations_views')->select("presentation_id",DB::raw('count(*) as total'))->groupBy('presentation_id')->orderBy('total','DESC')->first()->presentation_id);
        for($i = 0;$i<count($presentations);$i++){
            $views = DB::table('presentations_views')
                ->select(DB::raw('count(*) as total'))
                ->where("presentation_id",$presentations[$i]->id)
                ->groupBy('presentation_id')
                ->first();
            $previw[$i] = array('nom'=>$presentations[$i]->nom,'views'=>$views == null ? 0 : $views->total);
        }
		return view('home',compact("previw","totalviews","totalviewsweek","toppresentation"));
	}

}
