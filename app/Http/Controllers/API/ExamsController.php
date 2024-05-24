<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignExam;

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
}
