<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $roles = Role::all();

        \App\Models\User::factory(10)->create()->each(function ($user) use ($roles) {
            $randomRoleId = $roles->random(1)->first()->id;
            $user->roles()->attach($randomRoleId);
        });


        // Fill user_roles table
        $users = \App\Models\User::all();
        $users->each(function ($user) use ($roles) {
            $userRoles = $roles->random(rand(1, $roles->count()))->pluck('id')->toArray();
            $user->roles()->sync($userRoles);
        });




        $users = \App\Models\User::all();

        foreach ($users as $user) {
            $user->vehicles()->saveMany(
                \App\Models\Vehicle::factory()->count(rand(0, 3))->make()
            );
        }



        \App\Models\Repair::factory()->count(200)->create()->each(function ($repair) use ($users) {
            $randomUser = $users->random(1)[0];

            if ($randomUser->vehicles->count() != 0) {
                $repair->user_id = $randomUser->id;
                $repair->vehicle_id = $randomUser->vehicles->random(1)[0]->id;
                $repair->save();
            }
        });

        $users = \App\Models\User::all();


        \App\Models\SparePart::factory()->count(100)->create();

        $repairs = \App\Models\Repair::all();


        \App\Models\Invoice::factory()->count(50)->create()->each(function ($invoice) use ($repairs, $users) {
            $randomRepair = $repairs->random(1)[0];
            $randomUser = $users->random(1)[0];

            $invoice->repair_id = $randomRepair->id;
            $invoice->user_id = $randomUser->id;
            $invoice->save();
        });
        $spareParts = \App\Models\SparePart::all();


        $repairs->each(function ($repair) use ($spareParts) {
            $sparePartsToAdd = $spareParts->random(rand(0, $spareParts->count()));

            $pivotData = $sparePartsToAdd->mapWithKeys(function ($sparePart) {
                return [$sparePart->id => ['quantity' => rand(1, 100)]];
            });

            $repair->spareParts()->syncWithoutDetaching($pivotData);
        });
    }
}
