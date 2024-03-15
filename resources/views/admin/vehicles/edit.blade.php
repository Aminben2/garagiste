@extends('admin.index')
@section('content')
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger border-0 bg-danger alert-dismissible fade show py-2">
                <div class="d-flex align-items-center">
                    <div class="font-35 text-white"><i class='bx bxs-message-square-x'></i>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 text-white">Danger Alerts</h6>
                        <div class="text-white">{{ $errors->first() }}</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4">Update Vehicle</h5>
                    <form class="row g-3" method="post" action="{{ route('vehicles.update', ['vehicle' => $vehicle]) }}">
                        <div class="col-md-12">
                            @method('PUT')
                            @csrf
                            <label for="input25" class="form-label">Make</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="lni lni-car"></i></span>
                                <input name="make" type="text" class="form-control" id="input25"
                                    placeholder="First Name" value="{{ $vehicle->make ?? old('make') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Model</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-display"></i></span>
                                <input name="model" type="text" class="form-control" id="input26"
                                    placeholder="Last Name" value="{{ $vehicle->model ?? old('model') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input26" class="form-label">Fuel TYpe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-droplet"></i></span>
                                <input name="fuelType" type="text" class="form-control" id="input26"
                                    placeholder="fuelType" value="{{ $vehicle->fuelType ?? old('fuelType') }}">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input27" class="form-label">Registration</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                                <input name="registration" type="text" class="form-control" id="input27"
                                    placeholder="registration" value="{{ $vehicle->registration ?? old('registration') }}">
                            </div>
                        </div>

                        <div class="col-md-12">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                                <button type="reset" class="btn btn-light px-4">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
