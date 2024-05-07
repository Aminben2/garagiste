<?php

namespace App\Http\Controllers;

use App\Mail\NotifyClientAboutRepair;
use App\Mail\NotifyClientInvoice;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notifyClientAboutRepair(Request $request)
    {
        $mailData = $request->validate([
            'userEmail' => 'required|email',
            'vehicle_id' => 'required',
            'repair_id' => 'required',
        ]);
        $vehicle = Vehicle::findOrFail($mailData['vehicle_id']);
        $mailData['registration'] = $vehicle->registration;
        $mailData['title'] = "Your vehicle repair is done";

        Mail::to($mailData['userEmail'])->send(new NotifyClientAboutRepair($mailData));
    }

    public function notifyClientAboutInvoice(Request $request)
    {
        $mailData = $request->validate([
            'userEmail' => 'required|email',
            'invoice_id' => 'required',
        ]);
        $mailData['title'] = "Your invoice is ready to be payed";

        Mail::to($mailData['userEmail'])->send(new NotifyClientInvoice($mailData));
    }
}
