@extends('admin.layouts.app')
@section('title','HMS | Payments')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Payments</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hajjis</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row" id="paymentDetails">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Hajji search for take payment</h2><hr>
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="ng" class="form-control" id="search_ng" placeholder="Search by NG...">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="mobile" class="form-control" id="search_mobile" placeholder="Search by mobile no...">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="nid" class="form-control" id="search_nid" placeholder="Search by NID...">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-success" id="btnSearch">Search <i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div> 
            </div>--}}

            <div class="card paymentsTableDiv">
                <div class="card-body">
                    <h2 class="header-title">All Payments</h2><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="paymentsTable">
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
                                
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class="col-md-4 newPayment">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">New Payments</h2><hr>

                    <form action="{{ route('admin.payments.store') }}" method="post" class="needs-validation" id="payment-form" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="hajji_id" class="form-label">Select Hjji</label>
                            <select name="hajji_id" class="form-control select2" id="hajji_id" required>
                                <option value="" selected disabled>---Please Select Hajji---</option>
                                @foreach ($hajjis as $hajji)
                                    <option value="{{ $hajji->id }}">{{ $hajji->name }} [ {{ $hajji->ng }} ]</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3">
                            <label class="col-form-label">Payment date</label>
                            <div class="input-group position-relative" id="payment_date">
                                <input name="payment_date" type="text" class="form-control" data-provide="datepicker" data-date-format="dd-m-yyyy" data-date-autoclose="true" data-date-container="#payment_date" placeholder="DD/MM/YYYY" autocomplete="off">
                                <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                            </div><!-- input-group -->
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3">
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
                        <div class="mb-3 d-none" id="bank_name">
                            <label for="bank_name" class="form-label">Bank name</label>
                            <input name="bank_name" type="text" class="form-control" placeholder="Type bank name here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3  d-none" id="branch_name">
                            <label for="branch_name" class="form-label">Branch name</label>
                            <input name="branch_name" type="text" class="form-control"  placeholder="Type branch name here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3 d-none" id="check_no">
                            <label for="check_no" class="form-label">Check no</label>
                            <input name="check_no" type="text" class="form-control" id="check_no" placeholder="Type check no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3  d-none" id="issue_date">
                            <label class="col-form-label">Issue date</label>
                            <div class="input-group position-relative" id="issue_date_box">
                                <input name="issue_date" type="text" class="form-control" data-provide="datepicker" data-date-format="dd-m-yyyy" data-date-autoclose="true" data-date-container="#issue_date_box" placeholder="DD/MM/YYYY" autocomplete="off">
                                <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                            </div><!-- input-group -->
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3  d-none" id="deposite_no">
                            <label for="deposite_no" class="form-label">Deposite no</label>
                            <input name="deposite_no" type="text" class="form-control"  placeholder="Type deposite no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3  d-none" id="transaction_no">
                            <label for="transaction_no" class="form-label">Transaction no</label>
                            <input name="transaction_no" type="text" class="form-control"  placeholder="Type transaction no here" >
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input name="amount" type="number" class="form-control" id="amount" placeholder="Type amount here" required>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-3">
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
@endsection

@push('css')
    <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/admin/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endpush

@push('vendorjs')
    <script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    
    <script src="{{ asset('assets/admin/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/moment/min/moment.min.js') }}"></script>

    <script src="{{ asset('assets/admin/libs/select2/js/select2.min.js') }}"></script>
@endpush

@push('scripts')
    <script src="{{ asset('assets/admin/js/pages/form-pickers.init.js') }}"></script>
    {{-- <script src="{{ asset('assets/admin/js/pages/form-advanced.init.js') }}"></script> --}}

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
            
            //select2
            $('.select2').select2();

            // $('#btnSearch').on('click',function () {
            //     const el = $(this);
            //     const data = {};
            //     data.ng = $('#search_ng').val().trim();
            //     data.mobile = $('#search_mobile').val().trim();
            //     data.nid = $('#search_nid').val().trim();

            //     $.ajax({
            //         url: "/admin/hajjis/get-hajji-for-payment",
            //         method: "post",
            //         dataType: "json",
            //         data: data,
            //         headers : {
            //             "X-CSRF-TOKEN": $('input[name="_token"]').val()
            //         },
            //         beforeSend: function (data) {
            //             el.html(`Loading  <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>`).prop('disabled', true);
            //         },
            //         success: function (response) {
            //             console.log(response);
            //             el.html(`Search <i class="fas fa-search"></i>`).prop('disabled', false);
            //             $('.paymentTableDiv').removeClass('d-none');
            //         }
            //     });
              
            // })

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

            $('#hajji_id').on('change',function () { 
                const el = $(this);
                const id = el.val();
                $.ajax({
                    url: "/admin/hajjis/get-payments-by-hajji",
                    method: "post",
                    dataType: "json",
                    data: {id:id},
                    headers : {
                        "X-CSRF-TOKEN": $('input[name="_token"]').val()
                    },
                    beforeSend: function (data) {
                        el.prop('disabled', true);
                        $('#paymentsTable tbody').html(`<tr><td colspan="6" class="text-center text-muted display-4">Loding...<div class="spinner-grow text-seconday m-2" role="status"></div></td></tr>`);
                    },
                    success: function (response) {
                        addRow(response.data)
                        el.prop('disabled', false);
                    }
                });
            });

            function addRow(data) { 
                console.log(data);
                $('#paymentsTable tbody').html(''); 
                let html = ``;

                if (data.length > 0) {
                    data.forEach((row, indx) => {
                        html+=`<tr>
                                <td>${indx+1}</td>
                                <td>${row.payment_method}</td>
                                <td>${row.bank_name===null?'N/A':row.bank_name}</td>
                                <td>${row.amount.toLocaleString()}/-</td>
                                <td>${row.payment_date	}</td>
                                <td>
                                    <button class="btn btn-outline-info waves-effect waves-light" title="Show details" data-id="${row.id}"><i class="fas fa-eye"></i></button>
                                </td>
                            </tr>`;
                        });
                }else{
                    html+=`<tr><td colspan="6" class="text-center text-muted display-4">No data found...</td></tr>`;
                }

                $('#paymentsTable tbody').html(html);
                
            }

        });
    </script>
    
    
@endpush