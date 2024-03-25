<?php

namespace App\Http\Controllers;

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

    public function show(User $client)
    {
        $invoices = $client->invoices;
        return view("admin.users.clients.invoices", compact("invoices"));
    }
}
