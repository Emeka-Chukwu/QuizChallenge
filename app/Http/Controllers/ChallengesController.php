<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Challenge;
use App\Http\Resources\Challenge as ChallengeResource;
use Illuminate\Support\Facades\Auth;

class ChallengesController extends Controller
{
   
 
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $challenges = Challenge::orderBy('created_at','desc')->paginate(10);
        
        // return 'not okayyyyyyyyyyyyyyyy';
        return ChallengeResource::collection($challenges);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $challenge = new Challenge();
        $challenge->challenge = $request->input('challenge');
        $challenge->topic_id = $request->input('topic');
        $challenge->subject_id = $request->input('subject');
        // $challenge->user_ids = auth()->user()->id;
        $challenge->user_id = $request->input('user_id');
        // return $challenge;
        $challenge->started = 0;
        $challenge-> completed = 0;
        $challenge->save();
        return new ChallengeResource($challenge);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $challenge = Challenge::find($id);
        
        return new ChallengeResource($challenge);
    }

   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $challenge = Challenge::find($id);
        $challenge->challenge = $request->input('challenge');
        $challenge->topic_id = $request->input('topic');
        $challenge->subject_id = $request->input('subject');
        $challenge->user_id = $request->input('user_id');
        // return $challenge;
        $challenge->save();
        return new ChallengeResource($challenge);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $challenge = Challenge::find($id);
        $challenge->remove();
    }

    public function categorizeChallenge($id)
    {
        $challenges = Challenge::where('topic_id', $id)->orderBy('created_at','desc')->paginate(5);
        return new ChallengeResource($challenges);
    }


}
