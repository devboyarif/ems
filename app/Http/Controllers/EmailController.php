<?php

namespace App\Http\Controllers;

use App\Models\Email;
use App\Models\EmailGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmailController extends Controller
{
    public function index()
    {
        $emails = Email::latest()->get();

        return $emails;
    }

    public function attachGroup(Email $email, EmailGroup $email_group)
    {
        $email->update([
            'email_group_id' => $email_group->id,
        ]);

        return response()->json([
            'message' => 'Email attached to group successfully',
        ], Response::HTTP_CREATED);
    }

    public function detachGroup(Email $email)
    {
        $email->update([
            'email_group_id' => null,
        ]);

        return response()->json([
            'message' => 'Email detached from group successfully',
        ], Response::HTTP_OK);
    }
}
