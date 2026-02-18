<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact');
    }

    public function getStoredMessages(Request $request )
    {
        try{
            $getStored = Contact::all();
            return response()->json([
                'storedMessages' => $getStored,
                'message' => 'successful'
            ], 200);

        } catch (\Exception $e){
             Log::error('Error while retreiving messages: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
        }

    }


    // stores message
    public function store(Request $request)
    {
        try {
            Log::info('Contact form received data:', $request->all()); // Debug log
    
            // Validate request data for simple contact form
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'nullable|string|max:20',
                'comments' => 'required|string',
            ]);
            
            $contactData = [
                'first_name' => $validated['name'],
                'last_name' => '',
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? '',
                'message' => $validated['comments'],
            ];

            // Store contact in the database
            $contact = Contact::create($contactData);
    
            // Send email to admin
            // Mail::to('info@datapavellc.com')->send(new ContactMail($contact));
    
            Log::info('Contact form submitted successfully.', ['contact' => $contact]);
    
            return back()->with('success', 'Message sent successfully!');


        } catch (\Exception $e) {
            Log::error('Error in contact form submission: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
    
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
    
   
}