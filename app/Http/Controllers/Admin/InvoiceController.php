<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Exports\InvoicesExport;
use App\Imports\InvoiceImport;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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

        $response = Http::post('/admin/notify-client-about-invoice', [
            'userEmail' => $invoice->user->email,
            'invoice_id' => $invoice->id,
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            return redirect()->back()->with("status", "Invoice created successfully and notified client");
        } else {
            $errorMessage = $response->body();
            return redirect()->back()->with("status", "Invoice created successfully but failed to notify client: " . $errorMessage);
        }
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
        $response = Http::post('/admin/notify-client-about-invoice', [
            'userEmail' => $invoice->user->email,
            'invoice_id' => $invoice->id,
        ]);

        if ($response->successful()) {
            return redirect()->route("invoices")->with("status", "Invoice updated successfully and notified client");
        } else {
            $errorMessage = $response->body();
            return redirect()->route("invoices")->with("status", "Invoice updated successfully but failed to notify client: " . $errorMessage);
        }
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
