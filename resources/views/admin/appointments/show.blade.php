@extends('layouts.index')

@section('content')

    @component('client.components.location', [
        'page' => 'Appointments',
        'subpage' => '',
        'title' => 'Appointment Details',
    ])
    @endcomponent
    @if (!empty(session('status')))
        @component('admin.components.seccuss-alert', [
            'title' => __('Success Alerts'),
            'subTitle' => session('status'),
        ])
        @endcomponent
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Appointment Details</h4>
            </div>
            <div class="card-body">
                <p><strong>Id#:</strong> {{ $appointment->id }}</p>
                <p><strong>Title:</strong> {{ $appointment->title }}</p>
                <p><strong>Description:</strong> {{ $appointment->description }}</p>
                <p><strong>Start Date:</strong> {{ $appointment->start_datetime }}</p>
                <p><strong>End Date:</strong> {{ $appointment->end_datetime }}</p>
                <p><strong>Client username:</strong> {{ $appointment->user->email }}</p>
                <p><strong>Client email:</strong> {{ $appointment->user->email }}</p>
                <p><strong>Client phone:</strong> {{ $appointment->user->phoneNumber }}</p>
                @if ($appointment->mechanic)
                    <p><strong>Mechanic:</strong> {{ $appointment->mechanic->username }}</p>
                @else
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <p><strong>Mechanic:</strong> N/A</p>
                        <button title="Assign" data-bs-toggle="modal" data-bs-target="#selectMechanicModal"
                            onclick="selectMechanic({{ $appointment->id }})" class="btn btn-sm btn-primary">Assign</button>
                    </div>
                @endif
                <p><strong>Vehicle:</strong> {{ $appointment->vehicle->registration }}</p>
                <p><strong>Status:</strong> {{ $appointment->status }}</p>
            </div>
        </div>
    </div>
    @include('admin.modals.select-mechanic')
    <script>
        function selectMechanic(id) {
            const confirmForm = document.getElementById('confirmForm');
            confirmForm.action = '/admin/appointments/' + id + '/assign';
        }
    </script>
@endsection
