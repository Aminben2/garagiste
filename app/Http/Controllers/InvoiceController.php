<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Imports\InvoiceImport;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $invoices = Invoice::all();
        return view("admin.invoices.index", compact("invoices", "users"));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
    public function import()
    {
        if (request()->hasFile('file')) {
            Excel::import(new InvoiceImport, request()->file('file'));
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
        return view("admin.invoices.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "description" => ['required', 'string', 'max:255'],
            "totalAmount" => ['required', 'numeric'],
            "additionalCharges" => ['required', 'numeric'],
            "dueDate" => ["required", "date"],
            "user_id" => ["required", "exists:users,id"],
        ]);

        $invoice = Invoice::create($request->all());
        return redirect()->back()->with("status", "Invoice created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show($invoice)
    {
        $data = Invoice::with("repairs")->find($invoice);
        return view("admin.invoices.show", compact("data"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        $users = User::all();
        return view("admin.invoices.edit", compact("invoice", "users"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        $request->validate([
            "description" => ['required', 'string', 'max:255'],
            "totalAmount" => ['required', 'numeric'],
            "additionalCharges" => ['required', 'numeric'],
            "dueDate" => ["required", "date"],
        ]);

        $invoice->update($request->all());
        return redirect()->route("invoices")->with("status", "Invoice updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        Invoice::destroy($invoice->id);
        return redirect()->back()->with("status", "Invoice deleted successfully");
    }
}
