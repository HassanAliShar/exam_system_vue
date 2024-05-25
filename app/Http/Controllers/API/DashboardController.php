<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AssignExam;
use App\Models\Paper;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        // get count of all users
        $total_user = User::count();
        // get count of Total Exams
        $total_exams = Paper::count();
        // get count of Assigned Exams
        $assigned_exams = AssignExam::where('status', 0)->count(); // get count of Assigned_exams
        // get count of subjects and papers
        $total_subjects = Subject::count();
        // get count of total assigned papers
        $total_assigned = AssignExam::count();
        return response()->json(
            [
                'total_user' => $total_user,
                'total_exams' => $total_exams,
                'assigned_exams' => $assigned_exams,
                'total_subjects' => $total_subjects,
                'total_assigned' => $total_assigned
            ]
        );
    }

    public function get_user_dashboard($id){
        try {
            // get count of Total Exams
            $total_exams = AssignExam::where('user_id', $id)->count();
            // get upcoming Exams compared to current date
            $upcoming_exams = AssignExam::where('user_id', $id)->where('from_date', '>=', date('Y-m-d'))->count();
            // get count of expired Exams
            $expired_exams = AssignExam::where('user_id', $id)->where('to_date', '<', date('Y-m-d'))->count();
            // get count of given and exams
            $given_exams = AssignExam::where('status', 1)->where('user_id', $id)->count();
            return response()->json(
                [
                    'total_exams' => $total_exams ?? 0,
                    'upcoming_exams' => $upcoming_exams ?? 0,
                    'assigned_exams' => $assigned_exams ?? 0,
                    'expired_exams' => $expired_exams ?? 0,
                    'given_exams' => $given_exams ?? 0
                ]
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function getUserNOtification($id){
        $user = User::findOrFail($id);
        $notifications = $user->notifications()->get();
        return response()->json($notifications);
    }
}
