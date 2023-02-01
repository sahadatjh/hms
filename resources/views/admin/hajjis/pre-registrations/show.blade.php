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
        <div class="col-md-3">

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
                                    <td>{{ $item->payment_date->toFormattedDateString(); }}</td>
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

{{--@push('vendorjs')

@endpush

@push('scripts')
    
@endpush --}}