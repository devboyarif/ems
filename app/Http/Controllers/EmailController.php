<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachEmailGroupRequest;
use App\Http\Requests\DetachEmailGroupRequest;
use App\Http\Requests\SendEmailRequest;
use App\Models\Email;
use App\Mail\SendEmail;
use App\Models\EmailGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        // get all emails
        $emails = Email::latest()->get();

        return $emails;
    }

    public function sendEmail(SendEmailRequest $request)
    {
        $emails = $request->emails;

        // store emails in database and queue them for sending
        foreach ($emails as $email) {
            Email::create([
                'email' => $email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
        }

        // send email to each email
        foreach ($emails as $email) {
            $content = [
                'subject' => $request->subject,
                'message' => $request->message,
            ];

            Mail::to($email)->queue(new SendEmail($content));

            if( count(Mail::failures()) > 0 ) {
                return response()->json([
                    'message' => "Email failed to send",
                ], Response::HTTP_BAD_REQUEST);
            }
        }

        // return response
        return response()->json([
            'message' => "Email queued successfully for sending",
        ], Response::HTTP_CREATED);
    }

    public function attachEmailGroup(AttachEmailGroupRequest $request)
    {
        // find email group
        $email_group = EmailGroup::find($request->group_id);

        // attach emails to group
        foreach ($request->email_ids as $email) {
            $email = Email::find($email);

            $email->update([
                'email_group_id' => $email_group->id,
            ]);
        }

        // return response
        return response()->json([
            'message' => "Emails attached to {$email_group->name} group successfully",
        ], Response::HTTP_CREATED);
    }

    public function detachEmailGroup(Request $request)
    {
        // validate request
        $request->validate([
            'email_ids' => 'required|array'
        ]);

        // detach emails from group
        foreach ($request->email_ids as $email) {
            $email = Email::find($email);

            $email->update([
                'email_group_id' => null,
            ]);
        }

        // return response
        return response()->json([
            'message' => 'Email detached from group successfully',
        ], Response::HTTP_OK);
    }
}
