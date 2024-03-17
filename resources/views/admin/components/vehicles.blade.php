@props(['vehicles'])
<div class="card mt-5">
    <div class="card-body">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('User Vehicles') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Basic information about the user vehicles.') }}
        </p>
        <div class="table-responsive">
            @if ($vehicles->count() === 0)
                <div class="alert alert-primary border-0 bg-primary alert-dismissible fade show">
                    <div class="text-white">User has no vehicles</div>
                </div>
            @else
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Fuel Type</th>
                            <th>Registration</th>
                            <th>Start Date</th>
                        </tr>@dd($vehicles)
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->make }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->fuelType }}</td>
                                <td>{{ $vehicle->registration }}</td>
                                <td>{{ $vehicle->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
