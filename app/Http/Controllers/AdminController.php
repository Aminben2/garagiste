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



        // Charts data
        $chartData = [
            'users' => [],
            'invoices' => [],
            'repairs' => [],
            'vehicles' => [],
        ];

        for ($i = 0; $i < 12; $i++) {
            $month = now()->subMonths($i)->format('M');

            $chartData['users'][$month] = User::whereHas('roles', function ($query) {
                $query->where('name', 'client');
            })->whereBetween('created_at', [
                now()->subMonths($i)->startOfMonth(),
                now()->subMonths($i)->endOfMonth(),
            ])->count();

            $chartData['invoices'][$month] = Invoice::whereBetween('created_at', [
                now()->subMonths($i)->startOfMonth(),
                now()->subMonths($i)->endOfMonth(),
            ])->count();

            $chartData['repairs'][$month] = Repair::whereBetween('created_at', [
                now()->subMonths($i)->startOfMonth(),
                now()->subMonths($i)->endOfMonth(),
            ])->count();

            $chartData['vehicles'][$month] = Vehicle::whereBetween('created_at', [
                now()->subMonths($i)->startOfMonth(),
                now()->subMonths($i)->endOfMonth(),
            ])->count();
        }

        // Reverse the arrays
        $chartData['users'] = array_reverse($chartData['users']);
        $chartData['invoices'] = array_reverse($chartData['invoices']);
        $chartData['repairs'] = array_reverse($chartData['repairs']);
        $chartData['vehicles'] = array_reverse($chartData['vehicles']);

        // Get labels
        $chartLabels = array_keys($chartData['users']);

        // Get values
        $chartUsersData = array_values($chartData['users']);
        $chartInvoicesData = array_values($chartData['invoices']);
        $chartRepairsData = array_values($chartData['repairs']);
        $chartVehiclesData = array_values($chartData['vehicles']);


        return view('admin.stats', compact(
            'usersCount',
            'invoicesCount',
            'repairsCount',
            'vehiclesCount',
            'latestUsers',
            'latestInvoices',
            'latestRepairs',
            'latestVehicles',
            'chartLabels',
            'chartUsersData',
            'chartInvoicesData',
            'chartRepairsData',
            'chartVehiclesData'
        ));
    }
}
