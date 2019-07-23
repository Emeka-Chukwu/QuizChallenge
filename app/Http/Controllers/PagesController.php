<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Challenge;
use App\Question;

class PagesController extends Controller
{
 


     public function index()
    {
        $subjects = Subject::inRandomOrder()->paginate(6);
        return view('pages.index',['subjects'=>$subjects]);

        // $topics = Topic::inRandomOrder()->paginate(6);
        // return view('pages.index',['topics'=>$topics]);
    }
    public function challenges($challenge)
    {
        // return 'yeah';
        $challenges = Challenge::where('topic_id',$challenge)->inRandomOrder()->paginate(6);
        return view('pages.challenge',['challenges'=>$challenges]);

        // $challenges = Challenge::inRandomOrder()->paginate(6);
        // return view('pages.challenge')->with([
        //     'challenges' => $challenges,
        // ]);
    }

    public function startchallenge($challenge)
    {
        // return 'yeah';
        $question = Question::where('challenge_id',$challenge)->paginate(1);
        // return $question;
        return view('pages.quiz',['question'=>$question]);
    }
}
