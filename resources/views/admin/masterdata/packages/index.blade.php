@extends('admin.layouts.app')
@section('title','HMS | Packages')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Package List</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Masterdata</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Packages</a></li>
                        <li class="breadcrumb-item active">Package List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Basic Data Table</h2><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="packageTable">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$packages->isEmpty())
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $loop->iteration	 }}</td>
                                            <td>{{ $package->name }}</td>
                                            <td>{{ number_format($package->price) }}</td>
                                            <td>
                                                <button class="btn btn-outline-primary waves-effect waves-light btn-package-edit" title="Edit" data-id="{{ $package->id }}" data-name="{{ $package->name }}" data-price="{{ $package->price }}"><i class="fa fa-edit"></i></button>
                                                <a href="{{ route('admin.masterdata.packages.delete',$package->id) }}" class="btn btn-outline-danger waves-effect waves-light" title="Delete"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title" id="toastr-three">Add New Package</h2><hr>

                    <form action="{{ route('admin.masterdata.packages.store') }}" method="post" class="needs-validation" id="package-form" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Package name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Type package name" required>
                            <div class="invalid-feedback">
                                This field is required! 
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Package price</label>
                            <input name="price" type="number" class="form-control" id="price" placeholder="Type package name" required>
                            <div class="invalid-feedback">
                                This field is required! 
                            </div>
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
    <link href="{{ asset('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@push('vendorjs')
    <script src="{{ asset('assets/admin/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/admin/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    
    <script src="{{ asset('assets/admin/libs/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/pages/form-validation.init.js') }}"></script>

@endpush

@push('scripts')
    <script>
        $(document).ready(function () {
            //datatable initialization
            $('#packageTable').DataTable({
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
            $('.package-form').parsley();

            //edit package
            $('.btn-package-edit').on('click', function (e) {
                const el = $( this );
                const updateRoute = `{{ route("admin.masterdata.packages.update") }}`;
            
                $('#package-form').attr('action',updateRoute);
                $('#package-form').append(`<input name="id" type="hidden" value="${el.data('id')}">`);
                $('#name').val(el.data('name'));
                $('#price').val(el.data('price'));
            });
        });
    </script>
    
    
@endpush