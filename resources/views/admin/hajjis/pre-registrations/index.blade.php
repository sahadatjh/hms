@extends('admin.layouts.app')
@section('title','HMS | Pre Registration')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Pre-Registration</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Hajji</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Pre Registraion</a></li>
                        <li class="breadcrumb-item active">Pre Register Hajji</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Pre-Register Hajjis</h2>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="packageTable">
                            <thead>
                                <tr class="text-nowrap">
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input checkAll checkbox-20" type="checkbox" id="checkAll">
                                        </div>
                                    </th>
                                    <th>SL No</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>NG Number</th>
                                    <th>Mobile</th>
                                    <th>Package</th>
                                    <th>Price</th>
                                    <th>NID No</th>
                                    <th>Data Of Birth</th>
                                    <th>District</th>
                                    <th>Reference</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!$preRegisterHajjis->isEmpty())
                                    @foreach ($preRegisterHajjis as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox-20" type="checkbox" data-id="{{ $item->id }}" >
                                                </div>
                                            </td>
                                            <td>{{ $loop->iteration	 }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <img src="{{ asset('/dynamic-assets/hajji-photo').'/'.$item->photo }}" alt="Photo" class="rounded h-40">
                                            <td>{{ $item->ng }}</td>
                                            <td>{{ $item->mobile }}</td>
                                            <td>{{ $item->package->name }}</td>
                                            <td>{{ number_format($item->package->price) }}</td>
                                            <td>{{ $item->nid }}</td>
                                            <td>{{ date('d-m-Y', strtotime($item->dob)) }}</td>
                                            <td>{{ $item->get_district->name }}</td>
                                            <td>{{ $item->agent->name }}</td>
                                            <td>
                                                <span class="badge bg-danger">{{ number_format($item->package->price - ($item->payments->sum('amount')+$item->discount)) }}</span>
                                            </td>
                                            <td class="text-nowrap">
                                                <a href="{{ route('admin.hajjis.pre_registrations.show',$item->id) }}" class="btn btn-outline-info waves-effect waves-light" title="View"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin.hajjis.pre_registrations.edit',$item->id) }}" class="btn btn-outline-primary waves-effect waves-light" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="{{ route('admin.hajjis.pre_registrations.migrate',$item->id) }}" class="btn btn-outline-purple waves-effect waves-light" title="Move to running"><i class="fas fa-rocket"></i></a>
                                                {{-- <a href="{{ route('admin.hajjis.pre_registrations.delete',$item->id) }}" class="btn btn-outline-danger waves-effect waves-light" title="Delete"><i class="fa fa-trash"></i></a> --}}
                                                {{-- <form method="post" action="{{ route('admin.hajjis.pre_registrations.delete',$item->id) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-outline-danger waves-effect waves-light" title="Delete"><i class="fa fa-trash"></i></button>
                                                </form> --}}
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

            //checkbox
            $("#checkAll").change(function () {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });
        });
    </script>
    
    
@endpush