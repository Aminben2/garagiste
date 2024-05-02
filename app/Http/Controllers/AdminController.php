<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        $usersCount = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->count();
        $invoicesCount = Invoice::count();
        $repairsCount = Repair::count();
        $vehiclesCount = Vehicle::count();

        $latestUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'client');
        })->where('created_at', '>', now()->subYear())->latest()->count();
        $latestInvoices = Invoice::where('created_at', '>', now()->subYear())->latest()->count();
        $latestRepairs = Repair::where('created_at', '>', now()->subYear())->latest()->count();
        $latestVehicles = Vehicle::where('created_at', '>', now()->subYear())->latest()->count();
        return view('admin.stats', compact(
            'usersCount',
            'invoicesCount',
            'repairsCount',
            'vehiclesCount',
            'latestUsers',
            'latestInvoices',
            'latestRepairs',
            'latestVehicles',
        ));
    }
}
