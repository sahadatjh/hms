@extends('admin.layouts.app')
@section('title','HMS | Due List')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Due List</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Payments</a></li>
                        <li class="breadcrumb-item active">Due List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Hajji Due List</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="dueListTable">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Pay</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>01</td>
                                    <td>Mr Hajji</td>
                                    <td>A</td>
                                    <td>3,50,000/-</td>
                                    <td>10%</td>
                                    <td>2,20,000/-</td>
                                    <td>1,30,000/-</td>
                                    <td>
                                        <button class="btn btn-outline-info waves-effect waves-light" title="Show details" data-id=""><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td>Mr Hajji2</td>
                                    <td>B</td>
                                    <td>4,50,000/-</td>
                                    <td>30,000</td>
                                    <td>2,20,000/-</td>
                                    <td>1,30,000/-</td>
                                    <td>
                                        <button class="btn btn-outline-info waves-effect waves-light" title="Show details" data-id=""><i class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                {{-- @if (!$packages->isEmpty())
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration	 }}</td>
                                            <td>{{ $package->name }}</td>
                                            <td>{{ number_format($package->price) }}</td>
                                            <td>
                                                <button class="btn btn-outline-primary waves-effect waves-light btn-package-edit" title="Edit" data-id="{{ $package->id }}" data-name="{{ $package->name }}" data-price="{{ $package->price }}"><i class="fas fa-pencil-alt"></i></button>
                                                <a href="{{ route('admin.masterdata.packages.delete',$package->id) }}" class="btn btn-outline-danger waves-effect waves-light" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif --}}
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>
    <!-- end page title -->
@endsection

@push('css')
    <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('vendorjs')
    <script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>    
@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            //datatable initialization
            $('#dueListTable').DataTable({
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

        });
    </script>
    
    
@endpush