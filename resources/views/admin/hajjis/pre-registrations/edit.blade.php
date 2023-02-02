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
                        <li class="breadcrumb-item active">Hajji Update</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h2 class="header-title">Hajji information update</h2><hr>
                    <form action="{{ route('admin.hajjis.pre_registrations.update') }}" method="post" class="needs-validation" id="hajji-form" enctype="multipart/form-data" novalidate >
                        @csrf
                        <input type="hidden" name="id" value="{{ $hajji->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input name="name" type="text" class="form-control" id="name" value="{{ $hajji->name }}" placeholder="Type hjji name" required autofocus>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fathers_name" class="form-label">Father's name</label>
                                    <input name="fathers_name" type="text" class="form-control" id="fathers_name" value="{{ $hajji->fathers_name }}" placeholder="Type fathers name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mothers_name" class="form-label">Mother's name</label>
                                    <input name="mothers_name" type="text" class="form-control" id="mothers_name" value="{{ $hajji->mothers_name }}" placeholder="Type mothers name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="spouse_name" class="form-label">Spouse name</label>
                                    <input name="spouse_name" type="text" class="form-control" id="spouse_name" value="{{ $hajji->spouse_name }}" placeholder="Type spouse name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input name="occupation" type="text" class="form-control" id="occupation" value="{{ $hajji->occupation }}" required>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input name="mobile" type="number" class="form-control" id="mobile" value="{{ $hajji->mobile }}" required>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="nid" class="form-label">NID Number</label>
                                    <input name="nid" type="number" class="form-control" id="nid" value="{{ $hajji->nid }}" required>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ng" class="form-label">NG Number</label>
                                    <input name="ng" type="text" class="form-control" id="ng" value="{{ $hajji->ng }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="tracking_number" class="form-label">Tracking number</label>
                                    <input name="tracking_number" type="text" class="form-control" id="tracking_number" value="{{ $hajji->tracking_number }}">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select name="gender" id="gender" class="form-control" required>
                                        <option value="" selected disabled>Select Gender</option>
                                        <option value="Male" {{ $hajji->gender==='Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $hajji->gender==='Female' ? 'selected' : '' }}>Female</option>
                                        <option value="Others" {{ $hajji->gender==='Others' ? 'selected' : '' }}>Others</option>
                                    </select>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="col-form-label">Date of birth</label>
                                    <div class="input-group position-relative" id="datepicker2">
                                        <input name="dob" type="text" class="form-control" value="{{ $hajji->dob }}" required data-provide="datepicker" data-date-format="dd-m-yyyy" data-date-autoclose="true" data-date-container="#datepicker2">
                                        <span class="input-group-text"><i class="ri-calendar-event-fill"></i></span>
                                    </div><!-- input-group -->
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="district_id" class="form-label">District</label>
                                    <select name="district_id" id="district_id" class="form-control" required>
                                        <option value="" disabled>Select District</option>
                                        @foreach ($districts as $district)
                                            <option value="{{ $district->id }}" {{ $district->id === $hajji->district_id ? 'selected' : '' }}>{{ $district->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="package_id" class="form-label">Package</label>
                                    <select name="package_id" id="package_id" class="form-control" required>
                                        <option value="" disabled>Select package</option>
                                        @foreach ($packages as $package)
                                        <option value="{{ $package->id }}" {{ $hajji->package_id===$package->id ? 'selected' : '' }}>{{ $package->name }} [ {{ $package->price }} ]</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input name="discount" type="number" class="form-control" id="discount" value="{{ $hajji->discount }}" placeholder="Type discount">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="is_percent" class="form-label">Percent / Flat</label>
                                    <select name="is_percent" id="is_percent" class="form-control">
                                        <option value="">Please Select</option>
                                        <option value="0" {{ $hajji->is_percent == 0 ? 'selected' : '' }}>Flat discount</option>
                                        <option value="1" {{ $hajji->is_percent == 1 ? 'selected' : '' }}>Percent</option>
                                    </select>
                                </div>
                                @if ($hajji->status === 2)
                                    <div class="col-md-6 mb-3">
                                        <label for="pid" class="form-label">PID number</label>
                                        <input name="pid" type="text" class="form-control" id="pid" required value="{{ $hajji->pid }}" placeholder="Type PID">
                                        <div class="invalid-feedback">This field is required! </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="passport_no" class="form-label">Passport number</label>
                                        <input name="passport_no" type="text" class="form-control" id="passport_no" required value="{{ $hajji->passport_no }}" placeholder="Type passport number">
                                        <div class="invalid-feedback">This field is required! </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="visa_number" class="form-label">Visa number</label>
                                        <input name="visa_number" type="text" class="form-control" id="visa_number" required value="{{ $hajji->visa_number }}" placeholder="Type visa number">
                                        <div class="invalid-feedback">This field is required! </div>
                                    </div>
                                @endif
                                <div class="col-md-3 mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" class="form-control" rows="7" required>{{ $hajji->address }}</textarea>
                                    <div class="invalid-feedback">This field is required! </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="photo" class="form-label">Photo (Bellow to 200kb) </label>
                                    <input name="photo" type="file" class="dropify" data-default-file="{{ asset('/dynamic-assets/hajji-photo').'/'.$hajji->photo }}" data-height="150" data-allowed-file-extensions="jpg jpeg png svg"/>
                                </div>
                                @if ($hajji->status == 2)
                                    <div class="col-md-3 mb-3">
                                        <label for="passport_image" class="form-label">Passport Image (Bellow to 200kb) </label>
                                        <input name="passport_image" type="file" class="dropify" data-default-file="{{ asset('/dynamic-assets/passport').'/'.$hajji->passport_image }}" data-height="150" data-allowed-file-extensions="jpg jpeg png svg"/>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label for="visa_image" class="form-label">Visa Image (Bellow to 200kb) </label>
                                        <input name="visa_image" type="file" class="dropify" data-default-file="{{ asset('/dynamic-assets/visa').'/'.$hajji->visa_image }}" data-height="150" data-allowed-file-extensions="jpg jpeg png svg"/>
                                    </div>
                                @endif
                                <div class="{{ $hajji->status == 2 ? 'col-md-12' : 'col-md-6' }} mb-3">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" id="remarks" class="form-control" rows="7">{{ $hajji->remarks }}</textarea>
                                </div>
                            </div>
                            
                            <hr>
                            <button class="btn btn-success btn-lg float-end" type="submit"><i class="fa fa-save"></i> UPDATE</button>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>
    <!-- end page title -->

    @endsection

    @push('css')
        <link href="{{ asset('assets/admin/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/admin/libs/dropify/css/dropify.min.css') }}" rel="stylesheet"/>
    @endpush
    
    @push('vendorjs')
        <script src="{{ asset('assets/admin/libs/parsleyjs/parsley.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/pages/form-validation.init.js') }}"></script>

        <script src="{{ asset('assets/admin/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ asset('assets/admin/libs/moment/min/moment.min.js') }}"></script>

         <!-- Plugins js -->
         <script src="{{ asset('assets/admin/libs/dropify/js/dropify.min.js') }}"></script>
    @endpush
    
    @push('scripts')
        <script src="{{ asset('assets/admin/js/pages/form-pickers.init.js') }}"></script>

        <script>
            $(document).ready(function () {
                //form validation
                $('.package-form').parsley();
                
                //dropify image
                $('.dropify').dropify();
            });
        </script>
    @endpush