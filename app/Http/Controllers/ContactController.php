<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactSubmission;
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

        ContactSubmission::create($data);

        return Redirect::route('contact.show')->with('status','Message sent!');
    }
}
