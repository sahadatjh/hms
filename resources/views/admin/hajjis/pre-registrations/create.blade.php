@extends('admin.layouts.app')
@section('title','HMS | Add New Hajji')
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
                    <h2 class="header-title">Add New Hajji</h2><hr>
                    <form action="{{ route('admin.hajjis.pre_registrations.store') }}" method="post" class="needs-validation" id="hajji-form" novalidate >
                        @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name')}}" placeholder="Type hjji name" required autofocus>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fathers_name" class="form-label">Father's name</label>
                                    <input name="fathers_name" type="text" class="form-control" id="fathers_name" value="{{ old('fathers_name')}}" placeholder="Type fathers name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mothers_name" class="form-label">Mother's name</label>
                                    <input name="mothers_name" type="text" class="form-control" id="mothers_name" value="{{ old('mothers_name')}}" placeholder="Type mothers name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="spouse_name" class="form-label">Spouse name</label>
                                    <input name="spouse_name" type="text" class="form-control" id="spouse_name" value="{{ old('spouse_name')}}" placeholder="Type spouse name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input name="occupation" type="text" class="form-control" id="occupation" value="{{ old('occupation')}}" placeholder="Type occupation">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input name="mobile" type="text" class="form-control" id="mobile" value="{{ old('mobile')}}" placeholder="Type mobile Number">
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nid" class="form-label">NID Number</label>
                                    <input name="nid" type="number" class="form-control" id="nid" value="{{ old('nid')}}" placeholder="Type NID number">
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ng" class="form-label">NG Number</label>
                                    <input name="ng" type="text" class="form-control" id="ng" value="{{ old('ng')}}" placeholder="Type ng number">
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tracking_number" class="form-label">Tracking number</label>
                                    <input name="tracking_number" type="text" class="form-control" id="tracking_number" value="{{ old('tracking_number')}}" placeholder="Type tracking number">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="col-form-label">Date of birth</label>
                                    <div class="input-group position-relative" id="datepicker2">
                                        <input type="text" class="form-control" data-provide="datepicker" data-date-format="dd M, yyyy" data-date-autoclose="true" data-date-container="#datepicker2">
                                        <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="district_id" class="form-label">District</label>
                                    <select name="district_id" id="district_id" class="form-control">
                                        <option value="" selected disabled>Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Others">Others</option>
                                        
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="package_id" class="form-label">Package</label>
                                    <select name="package_id" id="package_id" class="form-control">
                                        <option value="" selected disabled>Select package</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control"></textarea>
                                </div>
                            </div>
                            
                            <button class="btn btn-success float-end" type="submit"><i class="fa fa-save"></i> SAVE</button>
                    
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>
    <!-- end page title -->

    @endsection

    @push('css')
        <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
    @endpush
    
    @push('vendorjs')
        <script src="{{ asset('assets/admin/libs/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/form-validation.init.js') }}"></script>

        <script src="{{ asset('assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/admin/libs/moment/min/moment.min.js') }}"></script>
    @endpush
    
    @push('scripts')
        <script src="{{ asset('assets/admin/js/pages/form-pickers.init.js') }}"></script>

        <script>
            $(document).ready(function () {
                //form validation
                $('.package-form').parsley();
            });
        </script>
        
        
    @endpush