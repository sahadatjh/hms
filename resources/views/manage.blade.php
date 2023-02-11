@extends('admin.layouts.app')
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box page-title-box-alt">
                <h4 class="page-title">Manage</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                        <li class="breadcrumb-item active">Controll</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>     
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <a href="{{ route('cache.clear') }}" class="btn btn-primary" role="button">Cache Clear</a>
                    <a href="{{ route('optimize.clear') }}" class="btn btn-primary" role="button">Optimize Clear</a>
                    <a href="{{ route('migrate') }}" class="btn btn-primary" role="button">Migrate</a>
                    <a href="{{ route('migrate.seed') }}" class="btn btn-primary" role="button">Migrate & seed</a>
                </div>
            </div>
        </div>
    </div>
@endsection