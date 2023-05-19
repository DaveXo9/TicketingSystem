<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StatusRequest;

class StatusController extends Controller
{
    public function index(){
        $statuses = Status::latest()->get();
        return view('status.index', compact('statuses'));
    }
    public function create(){
        return view('status.create');
    }
    
    public function store(StatusRequest $statusRequest){
        $formField = $statusRequest->validated();

        $status = Status::create($formField);

        return redirect('/')->with('message', 'Status created');
    }

    public function edit(Status $status){
        return view('status.edit', compact('status'));
    }

    public function update(StatusRequest $statusRequest, Status $status){
        $formFields = $statusRequest->validated();

        $status->update($formFields);

        return redirect('/')->with('message', 'Status updated');
    }

    public function destroy(Status $status){
        $status->delete();

        return redirect('/')->with('message', 'Status deleted');
    }
}
