@extends('admin.layouts.app')
@section('title','HMS | Hajji Details')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Hajji Details View</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hajji</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Show</a></li>
                        <li class="breadcrumb-item active">Details view</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Hajji details view</h2>
                    <hr>
                    
                    <table class="w-100 view-table">
                        <tr>
                            <th class="fw-bold">Name</th>
                            <th>{{ $hajji->name }}</th>
                            <td class="fw-bold"></td>
                            <td rowspan="4">
                                <img src="{{ asset('/dynamic-assets/hajji-photo/'.$hajji->photo) }}" alt="Image" class="img-thumbnail img-fluid float-end img-box">   
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold">Father's Name</td>
                            <td>{{ $hajji->fathers_name }}</td>
                        </tr>
                        <tr>
                            <th class="fw-bold">Mother's name</th>
                            <th>{{ $hajji->mothers_name }}</th>
                        </tr>
                        <tr>
                            <td class="fw-bold">Spouse Name</td>
                            <th>{{ $hajji->spouse_name }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">Occupaction</th>
                            <th>{{ $hajji->occupation }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">Mobile No.</th>
                            <th>{{ $hajji->mobile }}</th>
                            <td class="fw-bold">NID No.</td>
                            <th>{{ $hajji->nid }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">NG Number</th>
                            <th>{{ $hajji->ng }}</th>
                            <td class="fw-bold">Spouse Name</td>
                            <th>{{ $hajji->spouse_name }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">Tracking Number</th>
                            <th>{{ $hajji->tracking_number }}</th>
                            <td class="fw-bold">Date Of Birth</td>
                            <th>{{ date('d M Y',strtotime($hajji->dob)) }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">District</th>
                            <th>{{ $hajji->get_district->name }}</th>
                            <td class="fw-bold">Gender</td>
                            <th>{{ $hajji->gender }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">Package</th>
                            <th>{{ $hajji->package->name }}</th>
                            <td class="fw-bold">Price</td>
                            <th>{{ $hajji->package->price }}</th>
                        </tr>
                        <tr>
                            <th class="fw-bold">Discount</th>
                            <th>{{ $hajji->discount }} {{ $hajji->is_percent == 1 ? "%" : '' }}</th>
                            <th class="fw-bold">PID Number</th>
                            <th>{{ $hajji->pid ?? '-' }}</th>
                        </tr>
                        <tr>
                            <td class="fw-bold">Passport</td>
                            <th>{{ $hajji->passport_no ?? '-' }}</th>
                            <th class="fw-bold">Visa Number</th>
                            <th>{{ $hajji->visa_number ?? '-' }}</th>
                        </tr>
                        <tr>
                            <td class="fw-bold">Address</td>
                            <th>{{ $hajji->address }}</th>
                            <th class="fw-bold">Remarks</th>
                            <th>{{ $hajji->remarks }}</th>
                        </tr>
                        <tr>
                            @if ($hajji->visa_image)
                                <td>
                                    Passport <br>
                                    <img src="{{ asset('/dynamic-assets/passport/'.$hajji->passport_image) }}" alt="Passport " class="img-thumbnail img-fluid me-3 img-box">  
                                    Visa <br>
                                    <img src="{{ asset('/dynamic-assets/visa/'.$hajji->visa_image) }}" alt="Visa " class="img-thumbnail img-fluid img-box">  
                                </td>
                            @endif
                            <td class="fw-bold">Status</td>
                            <th>
                                @if ( $hajji->status == 1 )
                                    <h3 class="badge  bg-info">Pre Registered</h3>
                                @elseif( $hajji->status == 2 )
                                    <h3 class="badge  bg-primary">Runing</h3>
                                @elseif( $hajji->status == 3 )
                                    <h3 class="badge  bg-success">Archived</h3>
                                @elseif( $hajji->status == 4 )
                                    <h3 class="badge  bg-danger">Cancel/Transfer</h3>
                                @endif
                            </th>
                        </tr>
                    </table>
                    
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>

        <!----payments---->
        <div class="col-md-3 newPayment">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">New Payments</h2><hr>

                    <form action="{{ route('admin.payments.store') }}" method="post" class="needs-validation" id="payment-form" novalidate>
                        @csrf
                        <input type="hidden" name="hajji_id" value="{{ $hajji->id }}">
                        <div class="mb-1">
                            <label class="col-form-label">Payment date</label>
                            <div class="input-group position-relative" id="payment_date">
                                <input name="payment_date" type="text" class="form-control" data-provide="datepicker" data-date-format="dd-m-yyyy" data-date-autoclose="true" data-date-container="#payment_date" placeholder="DD/MM/YYYY" autocomplete="off">
                                <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                            </div><!-- input-group -->
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="payment_method" class="form-label">Payment method</label>
                            <select name="payment_method" class="form-control" id="payment_method" required>
                                <option value="" selected disabled>Select one method</option>
                                <option value="Cash payment">Cash payment</option>
                                <option value="Check payment">Check payment</option>
                                <option value="Bank Deposite">Bank Deposite</option>
                                <option value="Online pay">Online pay</option>
                            </select>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1 d-none" id="bank_name">
                            <label for="bank_name" class="form-label">Bank name</label>
                            <input name="bank_name" type="text" class="form-control" placeholder="Type bank name here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1  d-none" id="branch_name">
                            <label for="branch_name" class="form-label">Branch name</label>
                            <input name="branch_name" type="text" class="form-control"  placeholder="Type branch name here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1 d-none" id="check_no">
                            <label for="check_no" class="form-label">Check no</label>
                            <input name="check_no" type="text" class="form-control" id="check_no" placeholder="Type check no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1  d-none" id="issue_date">
                            <label class="col-form-label">Issue date</label>
                            <div class="input-group position-relative" id="issue_date_box">
                                <input name="issue_date" type="text" class="form-control" data-provide="datepicker" data-date-format="dd-m-yyyy" data-date-autoclose="true" data-date-container="#issue_date_box" placeholder="DD/MM/YYYY" autocomplete="off">
                                <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                            </div><!-- input-group -->
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1  d-none" id="deposite_no">
                            <label for="deposite_no" class="form-label">Deposite no</label>
                            <input name="deposite_no" type="text" class="form-control"  placeholder="Type deposite no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1  d-none" id="transaction_no">
                            <label for="transaction_no" class="form-label">Transaction no</label>
                            <input name="transaction_no" type="text" class="form-control"  placeholder="Type transaction no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="amount" class="form-label">Amount</label>
                            <input name="amount" type="number" class="form-control" id="amount" placeholder="Type amount here" required>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="remarks" class="form-label">remarks</label>
                            <textarea name="remarks" class="form-control" id="remarks" rows="5" placeholder="Write a comment here..."></textarea>
                        </div>
                        
                        <button class="btn btn-success float-end" type="submit"><i class="fa fa-save"></i> SAVE</button>
                    </form>
                </div>
            </div> 
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">All Payments</h2><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Payment Method</th>
                                    <th>Bank Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hajji->payments as $item)
                                <tr>
                                    <td>{{ $loop->iteration	 }}</td>
                                    <td>{{ $item->payment_method }}</td>
                                    <td>{{ $item->bank_name===null ? 'N/A' : $item->bank_name}}</td>
                                    <td>{{ number_format($item->amount,2) }}/-</td>
                                    <td>{{ date('d M Y', strtotime($item->payment_date)) }}</td>
                                    <td>
                                        <button class="btn btn-outline-info waves-effect waves-light" title="Show details" data-id="${row.id}"><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .view-table th, tr{
            padding: 15px 0px;
        }
        .img-box{
            height: 170px;
            width: 150px;
        }
    </style>
@endpush

@push('vendorjs')
    <script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    
    <script src="{{ asset('assets/admin/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/moment/min/moment.min.js') }}"></script>

@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/js/pages/form-pickers.init.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/form-advanced.init.js') }}"></script>

    <script>
        $(document).ready(function () {
            //datatable initialization
            $('#paymentsTable').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<i class='mdi mdi-chevron-left'>",
                        "next": "<i class='mdi mdi-chevron-right'>"
                    }
                },
                "drawCallback": function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                },
            });

            //form validation
            $('.payment-form').parsley();


            $('#payment_method').on('change', function () {
                const payment_method = $( this ).val();
                    if (payment_method) {
                    console.log(payment_method);
                    if (payment_method === "Cash payment") {
                        $('#branch_name, #bank_name, #check_no, #deposite_no, #transaction_no').addClass('d-none');
                        $("input[name=bank_name], input[name=branch_name], input[name=check_no], input[name=deposite_no], input[name=transaction_no]").prop('required',false);
                    }else if(payment_method === "Check payment"){
                        $('#bank_name, #branch_name, #check_no').removeClass('d-none');
                        $('#deposite_no, #transaction_no').addClass('d-none');
                        $("input[name=bank_name], input[name=branch_name], input[name=check_no], input[name=deposite_no]").prop('required',true);
                        $("input[name=deposite_no], input[name=transaction_no]").prop('required',false);
                    }else if(payment_method === "Bank Deposite"){
                        $('#branch_name, #bank_name, #deposite_no').removeClass('d-none');
                        $('#check_no, #transaction_no').addClass('d-none');
                        $("input[name=bank_name], input[name=branch_name],input[name=deposite_no]").prop('required',true);
                        $("input[name=check_no], input[name=transaction_no]").prop('required',false);
                    }else if(payment_method === "Online pay"){
                        $('#bank_name, #branch_name, #deposite_no, #check_no').addClass('d-none');
                        $('#transaction_no').removeClass('d-none');
                        $("input[name=bank_name], input[name=branch_name], input[name=check_no], input[name=deposite_no]").prop('required',false);
                        $("input[name=transaction_no]").prop('required',true);
                    }else{
                        alert('Please select any payment method.');
                    }
                }
            });


        });
    </script>
    
    
@endpush