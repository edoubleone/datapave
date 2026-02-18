<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class AppointmentController extends Controller
{
   
    public function appointment()
    {
        return view('appointment');
    }


    // Display the appointment form
    public function create()
    {
        return view('appointment');
    }

    public function getStoredMessages(Request $request )
    {
        try{
            $getStored = Appointment::all();
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

    // Store an appointment (Handles form submission & sends email)
    public function store(Request $request)
    {
        // Log the incoming request for debugging
        Log::info('Appointment booking request received.', ['request' => $request->all()]);

        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);

        try {
            // Create a new appointment record in the database
            $appointment = Appointment::create($validated);
            Log::info('Appointment created successfully.', ['appointment' => $appointment]);

            // Send a confirmation email to the admin
            // Mail::to('info@breemhealthcare.com')->send(new AppointmentMail($appointment));
            Log::info('Notification email sent to admin.');

            // Redirect with success message
            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            // Log the error and return failure response
            Log::error('Error booking appointment:', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to book appointment.'], 500);
        }
    }
}