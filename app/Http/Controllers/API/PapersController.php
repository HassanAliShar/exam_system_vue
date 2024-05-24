<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Paper;
use Illuminate\Http\Request;

class PapersController extends Controller
{
    public function index()
    {
        $papers = Paper::with('subject')->get();
        return response()->json($papers);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'subject_id' => 'required',
        ]);
        return Paper::create($request->all());
    }

    public function show($id)
    {
        $paper = Paper::find($id);
        return response()->json($paper);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $paper = Paper::find($id);
        $paper->update($request->all());
        return response()->json($paper);
    }

    public function destroy($id)
    {
        $paper = Paper::find($id);
        $paper->delete();
        return response()->json($paper);
    }
}
