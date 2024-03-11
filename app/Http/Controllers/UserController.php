<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');

        $usersQuery = User::query();

        if ($searchTerm) {
            $usersQuery
                ->where('username', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email', 'LIKE', "%{$searchTerm}%");
        }

        $users = $usersQuery->paginate(10);

        return view('admin.users.index', compact('users', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'address' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'array', 'exists:roles,id'], // new validation rule
        ]);

        $user = User::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'phoneNumber' => $request->input('phoneNumber'),
        ]);

        // Attach roles to the user
        $user->roles()->sync($request->input('role'));

        return redirect()->route('users')->with('status', 'User ' . $user->username . ' created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $vehicles = $user->vehicles;
        return view('admin.users.show', compact('user', 'vehicles'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'address' => ['nullable', 'string', 'max:255'],
            'phoneNumber' => ['nullable', 'string', 'max:20'],
            'role' => ['required', 'array', 'exists:roles,id'], // new validation rule
        ]);

        $user->update([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'address' => $request->input('address'),
            'phoneNumber' => $request->input('phoneNumber'),
        ]);

        // Attach roles to the user
        // Sync the roles with the user, updating any existing records.
        // This will remove any roles that are not included in the request,
        // and add any new roles included in the request.
        $user->roles()->sync($request->input('role', ["client"]));
        return redirect()->route('users')->with('status', 'User ' . $user->username . ' updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        // Delete the user repairs and associated records.
        $userRepairs = $user->repairs()->get();
        $repairIds = $userRepairs->pluck('id')->toArray();

        // Loop on repair ids and get the invoices by repair->invoices()
        foreach ($repairIds as $repairId) {
            // Get the invoices of a repair
            $repairInvoices = \App\Models\Repair::find($repairId)->invoices;
            // Loop on the invoices of a repair then delete each one of them from spare_part_invoice
            foreach ($repairInvoices as $invoice) {
                DB::table('spare_part_invoice')->where('invoice_id', $invoice->id)->delete();
            }
        }

        // Delete the invoices associated with the user repairs.
        DB::table('invoices')->whereIn('repair_id', $repairIds)->delete();

        // Delete the user repairs.
        foreach ($userRepairs as $repair) {
            $repair->delete();
        }

        // Delete the user vehicles.
        $user->vehicles()->delete();
        $user->roles()->sync([]);;
        $user->delete();
        return redirect()->route('users')->with('status', 'User ' . $user->username . ' deleted!');
    }
}
