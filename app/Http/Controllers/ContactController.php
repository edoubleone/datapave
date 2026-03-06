<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'nullable|string|max:20',
            'comments' => 'required|string',
        ]);

        try {
            $contact = Contact::create([
                'first_name' => $validated['name'],
                'last_name'  => '',
                'email'      => $validated['email'],
                'phone'      => $validated['phone'] ?? '',
                'message'    => $validated['comments'],
            ]);

            Mail::to('info@thedatapave.com')->send(new ContactMail($contact));

            Log::info('Contact form submitted.', ['contact_id' => $contact->id]);

            return back()->with('success', 'Message sent successfully!');

        } catch (\Exception $e) {
            Log::error('Contact form error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
