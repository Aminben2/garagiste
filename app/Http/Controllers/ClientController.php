<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $usersQuery = User::query();

        if ($searchTerm) {
            $usersQuery
                ->where('username', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }
        // Filter users with the role 'client'
        $usersQuery->whereHas('roles', function ($query) {
            $query->where('name', 'client');
        });

        $clients = $usersQuery->get();
        return view('admin.users.clients.index', compact('clients', 'searchTerm'));
    }

    public function clientInvoices(User $client)
    {
        $invoices = $client->invoices;
        return view("admin.users.clients.invoices", compact("invoices", "client"));
    }

    public function clientInvoiceRepairs(Invoice $invoice, Request $request)
    {
        $searchTerm = $request->input('search');

        $repairsQuery = $invoice->repairs();
        if ($searchTerm) {
            $repairsQuery->where(function ($query) use ($searchTerm) {
                $query->where('description', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('mechanicNotes', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('clientNotes', 'LIKE', "%{$searchTerm}%");
                // Add more search criteria if needed
            });
        }

        $clientRepairs = $repairsQuery->get();
        return view("admin.users.clients.repairs", compact("clientRepairs", "invoice"));
    }
}
