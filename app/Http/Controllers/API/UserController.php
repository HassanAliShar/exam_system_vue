<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AssignExam;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
            AssignExam::create($request->all());
            return response()->json($request->all());
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
