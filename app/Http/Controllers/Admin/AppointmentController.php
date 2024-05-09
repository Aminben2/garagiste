<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\NotifyClientAboutAppointment;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view("admin.appointments.index", compact("appointments"));
    }

    public function show(Appointment $appointment)
    {
        return view("admin.appointments.show", compact("appointment"));
    }

    public function edit(Appointment $appointment)
    {
        return view("admin.appointments.edit", compact("appointment"));
    }

    public function confirm(Appointment $appointment)
    {
        $appointment->update([
            "status" => "Confirmed",
        ]);

        return redirect()->route("admin.appointments")->with("status", "Appointment confirmed successfully");
    }

    public function attachRepair(Request $request, Appointment $appointment)
    {
        $request->validate([
            "mechanic_id" => "required|exists:users,id",
        ]);
        $appointment->update([
            "mechanic_id" => $request->mechanic_id
        ]);
        return redirect()->route("admin.appointments")->with("status", "Appointment attached to the mechanic successfully");
    }

    public function sendNotifAboutAppointment(Appointment $appointment)
    {
        $mailData = [
            'userEmail' => $appointment->user->email,
            'appointment_id' => $appointment->id,
            'appointmentTitle' => $appointment->title,
        ];
        $mailData['title'] = "Your appointment is accepted";

        Notification::create([
            "user_id" => $appointment->user->id,
            "title" => $mailData['title'],
            "content" => "Your invoice for repair is ready to be payed ,plaese pay it before it is too late",
        ]);

        Mail::to($appointment->user->email)->send(new NotifyClientAboutAppointment($mailData));

        return redirect()->back()->with("status", "Appointment sent successfully and notified client");
    }

    public function decline(Appointment $appointment)
    {
        $appointment->update([
            "status" => "Declined",
        ]);
        return redirect()->route("admin.appointments")->with("status", "Appointment declined successfully");
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            "start_datetime" => "sometimes|date",
            "end_datetime" => "sometimes|date",
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);
        $appointment->update($request->all());
        return redirect()->route("admin.appointments")->with("status", "Appointment updated successfully");
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route("admin.appointments")->with("status", "Appointment deleted successfully");
    }
}
