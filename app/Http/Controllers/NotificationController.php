<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index():View
    {
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}
