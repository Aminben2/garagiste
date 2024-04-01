@extends('admin.index')
@section('content')
    <div class="row row-cols-1 row-cols-lg-4">
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-deepblue text-white">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">Total Invoices</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-success d-flex justify-content-between text-success rounded-5 border-success border">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $invoicesCount }}</h2>
                            <p class="mb-0">{{ $latestInvoices }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-purple text-white">
                            <i class='bx bx-group'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">New Customers</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-danger d-flex justify-content-between text-danger rounded-5 border-danger border border-opacity-25">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $usersCount }}</h2>
                            <p class="mb-0">{{ $latestUsers }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-ibiza text-white">
                            <i class='bx bx-shopping-bag'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">Total Repairs</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-success d-flex justify-content-between text-success rounded-5 border-success border">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $repairsCount }}</h2>
                            <p class="mb-0">{{ $latestRepairs }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="widgets-icons-3 bg-gradient-success text-white">
                            <i class='bx bx-wallet'></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between mb-2 w-100">
                                <p class="mb-0">Total Vehicles</p>
                                <div class="">
                                    <span
                                        class="badge bg-light-danger d-flex justify-content-between text-danger rounded-5 border-danger border border-opacity-25">+
                                        2.4%</span>
                                </div>
                            </div>
                            <h2 class="mb-0">{{ $vehiclesCount }}</h2>
                            <p class="mb-0">{{ $latestVehicles }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <div class="card radius-10">
        <div class="card-header bg-transparent">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Appointments</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i
                            class="bx bx-dots-horizontal-rounded font-22 text-option"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Photo</th>
                            <th>Product ID</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Date</th>
                            <th>Shipping</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Iphone 5</td>
                            <td><img src="{{ asset('assets/images/products/01.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#9405822</td>
                            <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                            <td>$1250.00</td>
                            <td>03 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%">
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Earphone GL</td>
                            <td><img src="{{ asset('assets/images/products/02.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#8304620</td>
                            <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                            <td>$1500.00</td>
                            <td>05 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%">
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>HD Hand Camera</td>
                            <td><img src="{{ asset('assets/images/products/03.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#4736890</td>
                            <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                            <td>$1400.00</td>
                            <td>06 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 70%">
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Clasic Shoes</td>
                            <td><img src="{{ asset('assets/images/products/04.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#8543765</td>
                            <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                            <td>$1200.00</td>
                            <td>14 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Sitting Chair</td>
                            <td><img src="{{ asset('assets/images/products/06.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#9629240</td>
                            <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                            <td>$1500.00</td>
                            <td>18 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Hand Watch</td>
                            <td><img src="{{ asset('assets/images/products/05.png') }}" class="product-img-2"
                                    alt="product img"></td>
                            <td>#8506790</td>
                            <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                            <td>$1800.00</td>
                            <td>21 Feb 2020</td>
                            <td>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 40%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
