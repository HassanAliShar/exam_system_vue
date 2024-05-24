<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\ExamAssign;
use App\Models\AssignExam;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id',2)->get();
        return response()->json($users);
    }

    public function assign_exams(Request $request)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'paper_id' => 'required',
            'user_id' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'total_marks' => 'required',
            'passing_marks' => 'required',
            'attempt' => 'required',
        ]);
        if($validator){
            $created_exam = AssignExam::create($request->all());
            $exam = AssignExam::with('user')->with('paper')->find($created_exam->id);
            Mail::to($exam->user->email)->send(new ExamAssign($exam));
            return response([
                'status' => 200,
                'message' => 'Exam created successfully',
                'data' => $exam
            ]);
        }
        else{
            return response()->json($validator->errors());
        }
    }

    public function show($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }

}
