<?php

namespace App\Http\Controllers\API;

use App\Models\Subject;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    public function index()
    {
        return Subject::all();
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        return Subject::create($request->all());

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);
        $category = Subject::find($id);
        $category->update($request->all());
        return $category;
    }

    public function show($id){
        return view('categoreis.edit', ['category' => Subject::find($id)]);
    }

    public function edit($id){
        return Subject::find($id);
    }

    public function destroy($id){
        $category = Subject::find($id);
        $category->delete();
        return $category;
    }
}
