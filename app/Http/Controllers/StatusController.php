<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Requests\StatusRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StatusController extends Controller
{
    public function index():View{
        $statuses = Status::latest()->get();
        return view('status.index', compact('statuses'));
    }
    public function create():View{
        return view('status.create');
    }
    
    public function store(StatusRequest $statusRequest):RedirectResponse{
        $formField = $statusRequest->validated();

        $status = Status::create($formField);

        return redirect('/')->with('message', 'Status created');
    }

    public function edit(Status $status):View{
        return view('status.edit', compact('status'));
    }

    public function update(StatusRequest $statusRequest, Status $status):RedirectResponse{
        $formFields = $statusRequest->validated();

        $status->update($formFields);

        return redirect('/')->with('message', 'Status updated');
    }

    public function destroy(Status $status):RedirectResponse{
        $status->delete();

        return redirect('/')->with('message', 'Status deleted');
    }
}
