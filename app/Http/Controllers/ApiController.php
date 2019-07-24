<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use App\Http\Resources\Question as QuestionResource;
use App\Http\Resources\Answer as AnswerResource;


class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexofindex($id)
    {
        // return 'okay';
        // $question = Question::with('answers')->inRandomOrder()->paginate(5);
        // $question = Question::with('answers')->where('challenge_id', $id)->inRandomOrder()->paginate(5);
        $question = Question::where('challenge_id', $id)->inRandomOrder()->paginate(20);

        return QuestionResource::collection($question);
        return QuestionResource::collection($question);
        $question = Question::with('answers')->whinRandomOrder()->paginate(5);
        return QuestionResource::collection($question);
        
    }

 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // the validation of the variables
        $this->validate($request,[
            'question' => 'required',
            'challenge_id' => 'required',
            'correct_answer' => 'required',
            'choice_one' => 'required',
            'choice_two' => 'required'
        ]);
        // saving the quiz question 
        // return $request->all();
        $question = new Question();
        $question->question = $request->input('question');
        $question->challenge_id = $request->input('challenge_id');
        $correct_answer = $request->input('correct_answer');
        $question->save();

        // getting the array of answers

        $choices = [];
        $choices[1] = $request->input('choice_one');
        $choices[2] = $request->input('choice_two');
        $choices[3] = $request->input('choice_three');
        $choices[4] = $request->input('choice_four');
        // return $choices;
        // saving the answers to the questions

          // return $choices;
        //   foreach($choices as $choice => $value){
        //       $emeka = '';
        //       $emeka .= $choice.' '.$value. '<br>';
        //       echo $emeka;

        //   }
        $question->id;
         
          if($question->id)
          {
            //   return $choices;
              foreach($choices as $choice => $value)
              {
                //   echo $choice. '   shift '. $value;
              //    $show .= $choice .' '. $value .'<br>';
                  if($value != '')
                  {
                      if($correct_answer == $choice)
                      {
                          $is_correct = true;
                        //   echo $is_correct;
                      }
                      else
                      {
                          $is_correct = false;
                          echo $is_correct;
                      }
  
                    //   // store the choice here jare 
                      $option = new Answer();
                      $option->question_id = $question->id;
                      $option->answer = $value;
                      $option->is_correct = $is_correct;
                      if($option->is_correct){
                          $option->explanation = $request->input('explanation');
                      }
                   
                    //   return ' <br> solved =>';
                     $option->save();
                  }
                //   new AnswerResource($option);
              }
          }
        
          return new QuestionResource($question);
          
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $question = Question::with('answers')->where('challenge_id', $id)->inRandomOrder()->first();
        $question = Question::find($id);
        return new QuestionResource($question);
        // return QuestionResource::collection($question);
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
        // fetching the data by using the id
        
        // return $request->all();
        $question = Question::find($id);
        $question->question = $request->input('question');
        $question->challenge_id = $request->input('challenge_id');
        $correct_answer = $request->input('correct_answer');
        // return $question;
        $question->save();

        // choices array 
        $choices = [];
        $choices[1] = $request->input('choice_one');
        $choices[2] = $request->input('choice_two');
        $choices[3] = $request->input('choice_three');
        $choices[4] = $request->input('choice_four');
        //    return $choices;

        $optionsCounter = Answer::where('question_id',$id)->get();
        $optionarray = [];
        $counter = 0;
        $counterSecond = 0;
        foreach($optionsCounter as $singleOption){
            $optionarray[$counter] = $singleOption->id;
            $counter++;
        }
        // echo $optionarray[0].' '.$optionarray[1].' '. $optionarray[2].' '.$optionarray[3];
        // return $optionarray;
        // $optionId = $optionsCounter[0]->id;
        // $countarray = count($optionsCounter);
        

        if($question->id){

            foreach($choices as $choice => $value)
            {
            //    $show .= $choice .' '. $value .'<br>';
                if($value != '')
                {
                    // return $choice.' == '.$correct_answer;
                    if($choice == $correct_answer)
                    {
                        $is_correct = true;    
                    }
                    else
                    {
                        $is_correct = false;
                    }
                


                    // store the choice here jare 
                    $option = Answer::find($optionarray[$counterSecond]);
                    $option->question_id = $question->id;
                    // return $optionsCounter;
                    $option->answer = $value;
                    $option->is_correct = $is_correct;
                    // return 'me';
                    if($is_correct)
                    {
                        $option->explanation = $request->input('explanation');
                    }

                    $option->save();
                    
                    
                    $counterSecond++;

                // if($optionId >)
                }

                // new AnswerResource($option);
            
        }
        return new QuestionResource($question);

    }

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->remove();
    }
}
