<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SparePartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spareParts = SparePart::all();
        return view('admin.spare-parts.index', compact('spareParts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.spare-parts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'partName' => ['required', 'string', 'max:255'],
            'partReference' => ['required', 'string', 'max:255'],
            'supplier' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            "description" => ['required', 'string', 'max:255'],

        ]);

        $data = $request->only('partName', 'partReference', 'price', "stock", "supplier", "description");

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('spare-parts');
        }

        SparePart::create($data);

        return redirect()->route('spare-parts')->with('status', 'Spare part created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SparePart $sparePart)
    {
        return view('admin.spare-parts.show', compact('sparePart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SparePart $sparePart)
    {
        return view('admin.spare-parts.edit', compact('sparePart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SparePart $sparePart)
    {
        $request->validate([
            'partName' => ['required', 'string', 'max:255'],
            'partReference' => ['required', 'string', 'max:255'],
            'supplier' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'stock' => ['required', 'numeric'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            "description" => ['required', 'string', 'max:255'],
        ]);

        $data = $request->only('partName', 'partReference', 'price', 'stock', "supplier", "description");

        if ($request->hasFile('photo')) {
            // Delete existing image
            if ($sparePart->photo) {
                Storage::delete($sparePart->photo);
            }

            // Upload new image
            $data['photo'] = $request->file('photo')->store('spare-parts');
        }

        $sparePart->update($data);

        return redirect()->route('spare-parts')->with('status', 'Spare part updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SparePart $sparePart)
    {
        $sparePart->delete();
        return redirect()->route('spare-parts')->with('status', 'Spare part deleted!');
    }
}
