<?php

namespace App\Http\Controllers;

use App\Actions\Meetings\InviteUsersToMeetingAction;
use App\Dtos\Meetings\StoreMeetingData;
use App\Http\Requests\Meetings\StoreMeetingRequest;
use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Inertia\Testing\Assert;

class MeetController extends Controller
{
    public function index(): Response
    {
        $meetings = Meet::query()
            ->withCount('users')
            ->with('users:id,name,email')
            ->get()
            ->append('initials');

        return Inertia::render('Meetings/Index', [
            'meetings' => $meetings,
        ]);
    }

    public function create(): Response
    {
        $users = User::query()->get();

        return Inertia::render('Meetings/Create', [
            'users' => $users,
        ]);
    }

    public function store(StoreMeetingRequest $request, InviteUsersToMeetingAction $inviteUsersToMeetingAction): RedirectResponse
    {
        $response = $inviteUsersToMeetingAction::execute(StoreMeetingData::fromRequest($request));

        return redirect()->route('meetings.index')->with('message', $response);
    }

    public function show(Meet $meet): Response
    {
         $meet->loadCount('users')->load('users:id,name,email');

         $meet->users->each(static function (User $user) {
             $user->setAppends(['avatar']);
         });

        return Inertia::render('Meetings/Show', [
            'meet' => $meet,
        ]);
    }
}
