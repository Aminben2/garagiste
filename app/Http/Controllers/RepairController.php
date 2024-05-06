<?php

namespace App\Http\Controllers;

use App\Exports\RepairsExport;
use App\Imports\RepairsImport;
use App\Models\Invoice;
use App\Models\Repair;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RepairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repairs = Repair::all();
        return view("admin.repairs.index", compact("repairs"));
    }

    public function export()
    {
        return Excel::download(new RepairsExport, 'repairs.xlsx');
    }
    public function import()
    {
        if (request()->hasFile('file')) {
            Excel::import(new RepairsImport, request()->file('file'));
            return back()->with('status', 'Users imported successfully!');
        } else {
            return back()->with('status', 'Please select a file to import.');
        }
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mechanics = User::with("roles")->whereHas("roles", function ($q) {
            $q->where("name", "mechanic");
        })->get();
        $vehicles = Vehicle::all();
        $invoices = Invoice::all();
        return view("admin.repairs.create", compact("mechanics", "vehicles", "invoices"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required|string|max:255',
            'status' => 'in:pending,completed,in progress',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'workPrice' => 'required|numeric|min:0',
            'hours' => 'required|numeric|min:0',
            'hourPrice' => 'required|numeric|min:0',
            'mechanic_id' => 'required|exists:users,id',
            'vehicle_id' => 'required|exists:vehicles,id',
            'invoice_id' => 'nullable|exists:invoices,id',
            'title' => 'required|string|max:255',
        ]);
        $repair = Repair::create($request->all());

        return redirect()->back()->with("status", "Repair created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Repair $repair)
    {
        return view("admin.repairs.show", compact("repair"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        return view("admin.repairs.edit", compact("repair"));
    }

    public function updateStatus($repairId, $status)
    {

        if (!$status) {
            return response()->json(["error" => "status required"]);
        }

        $repair = Repair::find($repairId);

        $repair->status = $status;
        $repair->save();
        return response()->json(["status" => $repair->status, 'msg' => 'Status updated successfully']);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Repair $repair)
    {
        $request->validate([
            'description' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,completed,in progress',
            'startDate' => 'sometimes|date',
            'endDate' => 'sometimes|date|after_or_equal:startDate',
            'mechanicNotes' => 'nullable|string',
            'clientNotes' => 'nullable|string',
            'workPrice' => 'sometimes|numeric|min:0',
            'hours' => 'sometimes|numeric|min:0',
            'hourPrice' => 'sometimes|numeric|min:0',
            'title' => 'sometimes|string|max:255',
        ]);
        $repair->update($request->all());
        return redirect()->back()->with("status", "Repair updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Repair $repair)
    {
        $repair->delete();
        return redirect()->back()->with("status", "Repair deleted successfully");
    }
}
