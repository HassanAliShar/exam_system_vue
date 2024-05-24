<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ExameQuestion;

class QuestionsController extends Controller
{

    public function index($id)
    {
        $questions = ExameQuestion::with('paper')->where('paper_id', $id)->get();
        return response()->json($questions);
    }

    public function store(Request $request)
    {
        // $request->questions is array of questions with answers add all
        // return response()->json($request->all());
        try {
            foreach($request->all() ?? [] as $key => $question) {
                $quiz = new ExameQuestion();
                $quiz->question = $question['question'];
                $quiz->paper_id = $question['paper_id'];
                if($question['question_type'] == 'single') {
                    $quiz->answer = $question['answer'];
                } else {
                    $quiz->answer = implode(',', $question['answers']);
                }
                foreach($question['options'] as $index => $option) {
                    $propertyName = 'option'.($index+1); // Construct the property name
                    $quiz->{$propertyName} = $option['opt']; // Set the property ->opt;
                }
                $quiz->question_type = $question['question_type'];
                $quiz->marks = $question['marks'];
                $quiz->save();
            }
            return response()->json([
                'status' => 200,
                'message' => 'Questions added successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(). $th->getLine()
            ]);
        }
    }

    public function show($id)
    {
        $question = ExameQuestion::find($id);
        return response()->json($question);
    }

    public function update(Request $request, $id)
    {
        foreach($request->all() ?? [] as $key => $ques) {
            $question = ExameQuestion::find($id);
            $question->question = $ques['question'];
            $question->question_type = $ques['question_type'];
            $question->marks = $ques['marks'];
            if($ques['question_type'] == 'single') {
                $question->answer = $ques['answer'];
            } else {
                $question->answer = implode(',', $ques['answers']);
            }
            foreach($ques['options'] as $index => $option) {
                $propertyName = 'option'.($index+1); // Construct the property name
                $question->{$propertyName} = $option['opt']; // Set the property ->opt;
            }
            $question->update($request->all());
        }
        return response()->json([
            'status' => 200,
            'message' => 'Question updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $question = ExameQuestion::find($id);
        $question->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Question deleted successfully'
        ]);
    }
}
