<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class UserMeetingsController extends Controller
{
    public function __invoke(Request $request, User $user): Response
    {
        return Inertia::render('Users/Meetings/Index', [
            'user' => $user->loadCount('meets')->load('meets'),
        ]);
    }
}
