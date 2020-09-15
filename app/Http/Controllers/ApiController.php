<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Presentation;
use App\presentationsView;
use App\Question;
use App\viewDelai;
use Illuminate\Http\Request;
use League\Flysystem\Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Input;
use md5;
use App\Personnel;

class ApiController extends Controller
{


    private function personnelInArray($obj,$array){
        foreach($array as $i){
            if($i->id == $obj->id)
                return true;
        }
        return false;
    }


    /**
     * Returns Authentication JWT token
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $personnels = Personnel::where('email', $credentials['email'])->where('password', md5($credentials['password']))->get();
        if (count($personnels) != 0) {
            $personnel = $personnels[0];
            $token = JWTAuth::fromUser($personnel);
            return response()->json(compact('token'));
        } else {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
    }

    /**
     * Retrun User Object
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUser(Request $request)
    {
        try {
            $user = JWTAuth::parseToken()->toUser();
            if ($user)
                return $user;
            else
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }


    }

    /**
     * store presentation views
     *
     * @param Request $request
     * @return mixed
     */
    public function addViews(Request $request){

        try {
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $data =INPUT::get("data");
        for($i=0;$i<count($data);$i++){
            $vp = new presentationsView;
            $vp->presentation_id = $data[$i]["presentationid"];
            $vp->created_at = $data[$i]["date"];
            $vp->save();
        }
        return $data;
    }

    public function addQuestions(Request $request){
        try {
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $data =INPUT::get("data");
        for($i=0;$i<count($data);$i++){
            $question = new Question;
            $question->presentation_id = $data[$i]["presentationid"];
            $question->Question = $data[$i]["question"];
            $question->response = $data[$i]["response"];
            $question->repindex = $data[$i]["repindex"];
            $question->save();
        }
        return $data;
    }


    /**
     * store presentation Delai
     *
     * @param Request $request
     * @return mixed
     */
    public function addDelay(Request $request){
        try {
            $user = JWTAuth::parseToken()->toUser();
            if (!$user)
                return response()->json(['error' => 'invalid_credentials'], 401);
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        $data =INPUT::get("data");
        for($i=0;$i<count($data);$i++){
            $vp = new viewDelai;
            $vp->presentation_id = $data[$i]["presentationid"];
            $vp->delai = $data[$i]["delai"];
            $vp->save();
        }
        return $data;
    }

    /**
     * Return Zip file of the presentation
     *
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getFile(Request $request, $id)
    {

        try {
            $user = JWTAuth::parseToken()->toUser();
            if ($user) {
                $file = Presentation::find($id)->ZipURI;
                return response()->download($file);
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function listPresentation()
    {
        try {
            $user = JWTAuth::parseToken()->toUser();
            if ($user) {
                //$presentations = Presentation::all();
                $user1 = Personnel::find($user->id);
                $presentations = $user1->presentations;
                foreach($presentations as $p){
                    $p->users->toArray();
                    $p->groupes->toArray();
                    foreach($p->groupes as $g){
                        $g->personnels->toArray();
                        foreach($g->personnels as $pg){
                            if(!$this->personnelInArray( $pg, $p->users)){
                                $p->users[] = $pg;
                            }

                        }
                    }
                }
                return $presentations;
            } else {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        return response()->json(['status' => 'ok']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
