<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ExamSubmitted;
use Illuminate\Http\Request;
use App\Models\AssignExam;
use App\Models\Result;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ExamsController extends Controller
{
    //


    public function index()
    {
        $exams = AssignExam::with('paper.subject')->with('user')->get();
        // if exam status is 0 replace it with true
        foreach ($exams as $key => $value) {
            if ($value->status == 0) {
                $exams[$key]->status = true;
            }
            else{
                $exams[$key]->status = false;
            }
        }
        return response()->json($exams);
    }

    public function change_status(Request $request, $id){
        try {
            $assignExam = AssignExam::find($id);
            $assignExam->status = $request->status;
            $assignExam->save();
            return response()->json([
                'status' => 200,
                'message' => 'Exam status updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request){
        try {
            // return $request->all();
            $assignExam = AssignExam::find($request->id);
            $assignExam->from_date = $request->from_date;
            $assignExam->to_date = $request->to_date;
            $assignExam->passing_marks = $request->passing_marks;
            $assignExam->total_marks = $request->total_marks;
            $assignExam->attempt = $request->attempt;
            $assignExam->paper_id = $request->paper_id;
            $assignExam->update();
            return response()->json([
                'status' => 200,
                'message' => 'Exam status updated successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy($id){
        $assignExam = AssignExam::find($id);
        $assignExam->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Exam deleted successfully'
        ]);
    }

    public function show($id){
        try {
            $assignExam = AssignExam::find($id);
            return response()->json($assignExam);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function get_user_exams($id){
        try {
            $exams = AssignExam::with('paper.subject')->with('user')->where('user_id', $id)->get();
            return response()->json($exams);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function get_user_exams_questions($id){
        try {
            $exam = AssignExam::find($id);
            $exams = $exam->paper->questions;
            return response()->json($exams);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
    public function save_exams(Request $request){
        try{
            DB::beginTransaction();
            $correct_ans = 0;
            $wrong_ans = 0;
            $getting_marks = 0;
            $total_marks = 0;
            $exam = AssignExam::with('user')->find($request->id);
            // return $exam;
            foreach ($request->questions ?? [] as $key => $value) {
                $question = $exam->paper->questions()->find($value['id']);
                if($value['question_type'] == 'single'){
                    if($question->answer == $value['answer']){
                        $correct_ans++;
                        $getting_marks += $question->marks;
                    }
                    else{
                        $wrong_ans++;
                    }
                }
                if($value['question_type'] == 'multiple'){
                    // make question->answer as array
                    $db_ans = explode(',', $question->answer);
                    $req_ans = $value['answers'];

                    sort($db_ans);
                    sort($req_ans);
                    if($db_ans == $req_ans){
                        $correct_ans++;
                        $getting_marks += $question->marks;
                    }
                    else{
                        $wrong_ans++;
                    }
                }

            }
            $percentage = ($getting_marks / $exam->total_marks) * 100;
            $result = Result::create([
                'user_id' => $exam->user_id,
                'paper_id' => $exam->paper_id,
                'correct_answer' => $correct_ans,
                'wrong_answer' => $wrong_ans,
                'passing_marks' => $exam->passing_marks,
                'obtained_marks' => $getting_marks,
                'percentage' => $percentage,
                'attempt' => 1,
                'status' => ($percentage >= $exam->passing_marks) ? 'Pass' : 'Fail',
            ]);
            $exam->attempt = $exam->attempt - 1;
            $exam->status = 1;
            $exam->save();

            foreach ($request->questions ?? [] as $key => $value) {
                $userAns = UserAnswer::create([
                    'result_id' => $result->id,
                    'question_id' => $value['id'],
                    'answer' => $value['answer'] ?? implode(',', $value['answers']),
                ]);
            }
            $user = $exam->user;
            Mail::to($user->email)->send(new ExamSubmitted($result));
            DB::commit();
            return response()->json([
                'status' => 200,
                'data' => $result,
                'message' => 'Exam saved successfully'
            ]);
        }
        catch(\Throwable $th){
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }


    public function get_user_results($id){
        try {
            $results = Result::with('paper')->with('user')->find($id);
            return response([
                'status' => 200,
                'data' => $results,
                'message' => 'Exam results fetched successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function exams_results($id){
        try {
            $results = Result::with('paper')->with('user')->where('user_id', $id)->get();
            return response([
                'status' => 200,
                'data' => $results,
                'message' => 'Exam results fetched successfully'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }
}
