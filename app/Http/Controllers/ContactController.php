<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactSubmissionMail;
use App\Models\ContactSubmission;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','min:2'],
            'email' => ['required','email'],
            'message' => ['required','string','min:10'],
        ]);

        $submission = ContactSubmission::create($data);

        if (config('mail.contact.enabled')) {
            $recipient = new Address(
                config('mail.contact.address'),
                config('mail.contact.name')
            );

            Mail::to($recipient)->send(new ContactSubmissionMail($submission));
        }

        return Redirect::route('contact.show')->with('status','Message sent!');
    }
}
