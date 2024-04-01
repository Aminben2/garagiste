<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::all();
        return view("admin.invoices.index", compact("invoices"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view("admin.invoices.create", compact("users"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "description" => ['required', 'string', 'max:255'],
            "totalAmount" => ['required', 'numeric'],
            "additionalCharge" => ['required', 'numeric'],
            "dueDate" => ["required", "date"],
            "user_id" => ["required", "exists:users,id"],
        ]);

        $invoice = Invoice::create($request->all());
        return redirect()->back()->with("success", "Invoice created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        $repairs = $invoice->repairs;
        return view("admin.invoices.show", compact("invoice", "repairs"));
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
            "additionalCharge" => ['required', 'numeric'],
            "dueDate" => ["required", "date"],
            "user_id" => ["required", "exists:users,id"],
        ]);

        $invoice->update($request->all());
        return redirect()->back()->with("success", "Invoice updated successfully");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        Invoice::destroy($invoice->id);
        return redirect()->back()->with("success", "Invoice deleted successfully");
    }
}
