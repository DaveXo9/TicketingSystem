<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index(){
        $statuses = Status::latest();
        return view('status.index', compact('statuses'));
    }
    public function create(){
        return view('status.create');
    }
    
    public function store(Request $request){
        $formField = $request->validate([
            'status' => ['required', 'min:3']
        ]);

        $status = Status::create($formField);

        return redirect('/')->with('message', 'Status created');
    }

    public function edit(Status $status){
        return view('status.edit');
    }

    public function update(Request $request, Status $status){
        $formFields = $request->validate([
            'status' => ['required', 'min:3']
        ]);

        $status->update($formFields);

        return redirect('/')->with('message', 'Status updated');
    }

    public function destroy(Status $status){
        $status->delete();

        return redirect('/')->with('message', 'Status deleted');
    }
}
