<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $vehicles = Vehicle::all();

        $vehicles = Vehicle::query();

        $searchTerm = $request->input('search');

        if ($searchTerm) {
            $vehicles->where(function ($query) use ($searchTerm) {
                $query->where('model', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('make', 'LIKE', "%{$searchTerm}%")
                    ->orWhereHas('user', function ($query) use ($searchTerm) {
                        $query->where('username', 'LIKE', "%{$searchTerm}%");
                    });
            });
        }

        $vehicles = $vehicles->get();

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.vehicles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'required|string|unique:vehicles',
            'user_id' => 'required|exists:users,id', // Make sure user_id exists in users table
        ]);


        $vehicle = Vehicle::create($request->all());

        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->registration . ' created and attached to user!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vehicle $vehicle)
    {
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'fuelType' => 'required|string',
            'registration' => 'required|string|unique:vehicles,registration,' . $vehicle->id,
        ]);
        $vehicle->update($request->all());
        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->plate . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
        return redirect()->route('vehicles')->with('status', 'Vehicle ' . $vehicle->plate . ' deleted!');
    }
}
