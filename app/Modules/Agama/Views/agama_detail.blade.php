@extends('layouts.app')

@section('page-css')
@endsection

@section('main')

    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <a href="{{ route('agama.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary mb-1"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('agama.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $agama->nama }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Detail Data {{ $title }}: {{ $agama->nama }}</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <div class="row">
                                        <div class='col-lg-2'><p>Agama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $agama->agama }}</p></div>
									
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!--- end row -->
        </div> <!-- container -->

    </div> <!-- content -->
@endsection

@section('page-js')
@endsection

@section('inline-js')
@endsection