<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Http\Resources\SubjectTopic as ResourceSubjectTopic;
use App\Topic;

class topicsController extends Controller
{
    public function subject()
    {
        $subject = Subject::all();
        return ResourceSubjectTopic::collection($subject);
    }


    public function topic($id)
    {
        $topic = Topic::where('subject_id', $id)->paginate(20);
        return ResourceSubjectTopic::collection($topic);
    }

    public function createSubject(Request $request)
    {
        $this->validate($request,[
            'subject' => 'required'
        ]);
        
        $subject = new Subject();
        $subject->subject = $request->input('subject');
        $subject->description = $request->input('description');
        $subject->save();

    }

    public function createTopic(Request $request)
    {
        $this->validate($request,[
            'topic' => 'required'
        ]);
        
        $topic = new Topic();
        $topic->topic = $request->input('topic');
        $topic->description = $request->input('description');
        $topic->subject_id = $request->input('subject_id');
        $topic->save();

    }

    public function categorizeChallenge($id)
    {
        $challenges = Challenge::where('topic_id', $id)->orderBy('created_at','desc')->paginate(5);
        return new ChallengeResource($challenges);
    }
}
