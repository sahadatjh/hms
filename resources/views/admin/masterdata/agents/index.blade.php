@extends('admin.layouts.app')
@section('title','HMS | Agents')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Agents List</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Masterdata</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agent</a></li>
                        <li class="breadcrumb-item active">All Agents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">All Agents</h2><hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="agentTable">
                            <thead>
                                <tr>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>District</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$agents->isEmpty())
                                    @foreach ($agents as $agent)
                                        <tr>
                                            <td>{{ $loop->iteration	 }}</td>
                                            <td>{{ $agent->name }}</td>
                                            <td>{{ $agent->mobile }}</td>
                                            <td>{{ $agent->getDistrict->name }}</td>
                                            <td>
                                                <a href="{{ route('admin.masterdata.agents.edit',$agent->id) }}" class="btn btn-outline-primary waves-effect waves-light btn-agent-edit" title="Edit" ><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{ route('admin.masterdata.agents.delete',$agent->id) }}" class="btn btn-outline-danger waves-effect waves-light" title="Delete"><i class="fa fa-trash"></i></a>
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
                    <h2 class="header-title" >Add New Agent</h2><hr>

                    <form action="{{ route('admin.masterdata.agents.store') }}" method="post" class="needs-validation agent-form" id="agent-form" novalidate>
                        @csrf
                        <div class="mb-1">
                            <label for="name" class="form-label">Name</label>
                            <input name="name" type="text" class="form-control" id="name" placeholder="Type agent name" value="{{ old('name') }}" required>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="mobile" class="form-label">Mobile No. </label>
                            <input name="mobile" type="text" class="form-control" id="mobile" placeholder="Type mobile number"value="{{ old('mobile') }}" required>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="district_id" class="form-label">District </label>
                            <select name="district_id" id="district_id" class="form-control">
                                <option value="" disabled selected>Select District</option>
                                @foreach ($districts as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="Address" class="form-label">Address. </label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Type Address" value="{{ old('address') }}" required>
                            <div class="invalid-feedback">This field is required! </div>
                        </div>
                        <div class="mb-1">
                            <label for="photo" class="form-label">Photo </label>
                            <input name="photo" type="file" class="dropify" data-default-file="" data-height="150" data-allowed-file-extensions="jpg jpeg png svg"/>
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
    <link href="{{ asset('assets/admin/libs/dropify/css/dropify.min.css') }}" rel="stylesheet"/>


@endpush

@push('scripts')
    <!-- Plugins js -->
    <script src="{{ asset('assets/admin/libs/dropify/js/dropify.min.js') }}"></script>

    <script>
        (function () {
            $(document).ready(function () {
                //datatable initialization
                $('#agentTable').DataTable({
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
                $('.agent-form').parsley();

                //dropify image
                $('.dropify').dropify();
            });
        })(jQuery)

    </script>
    
    
@endpush