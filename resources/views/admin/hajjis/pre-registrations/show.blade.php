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
                    <div class="table-responsive">
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
                                <th>{{ $hajji->dob }}</th>
                            </tr>
                            <tr>
                                <th class="fw-bold">District</th>
                                <th>{{ $hajji->district }}</th>
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
                                <th>{{ $hajji->discount }} {{ $hajji->is_percent == 1 ? "%" : 'BDT' }}</th>
                                <td class="fw-bold">Address</td>
                                <th>{{ $hajji->address }}</th>
                            </tr>
                            @if ($hajji->status != 1)
                                <th class="fw-bold">Package</th>
                                <th>{{ $hajji->package->name }}</th>
                                <td class="fw-bold">Price</td>
                                <th>{{ $hajji->package->price }}</th>
                            @endif
                            <tr>
                                <th class="fw-bold">Remarks</th>
                                <th>{{ $hajji->remarks }}</th>
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
                    </div>
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
                    <h2 class="header-title">Payment Details</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="w-100 view-table">

                        </table>
                    </div>
                </div>
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