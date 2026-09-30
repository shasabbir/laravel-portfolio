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
        return view('contact', ['contactContent' => \App\Models\ContactContent::find(1) ?? new \App\Models\ContactContent]);
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','min:2','max:255'],
            'email' => ['required','email','max:255'],
            'message' => ['required','string','max:10000'],
        ]);

        $submission = ContactSubmission::create($data);

        if (config('mail.contact.enabled')) {
            $recipient = new Address(
                config('mail.contact.address'),
                config('mail.contact.name')
            );

            Mail::to($recipient)->send(new ContactSubmissionMail($submission));
        }

        $content = \App\Models\ContactContent::find(1) ?? new \App\Models\ContactContent;
        return Redirect::route('contact.show')->with('status', $content->value('success_message'));
    }

    public function inbox()
    {
        return view('admin.messages', ['messages' => ContactSubmission::latest('id')->paginate(20)]);
    }
}
