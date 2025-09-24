@extends('layouts.app')

@section('main')

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('jenisrekening.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Form Edit {{ $title }}</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Manajemen Data {{ $title }}</h4>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Form Edit Data {{ $title }}</h4>
                        </div>

                        <div class="card-body">
                            @include('include.flash')
                            <form class="form form-horizontal" action="{{ route('jenisrekening.update', $jenisrekening->id) }}" method="POST">
                                <div class="form-body">
                                    @csrf @method('patch')
                                    @foreach ($forms as $key => $value)
                                        @if ($key == '')
                                            {{ $value[1] }}
                                        @else
                                            <div class="row mb-1">
                                                <div class="col-md-3  text-sm-start text-md-end pt-2">
                                                    <label>{{ $value[0] }}</label>
                                                </div>
                                                <div class="col-md-9 form-group">
                                                    {{ $value[1] }}
                                                    @error($key)
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    <div class="offset-md-3 ps-2">
                                        <button class="btn btn-primary" type="submit">Simpan</button> &nbsp;
                                        <a href="{{ route('jenisrekening.index') }}" class="btn btn-secondary">Batal</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!--- end row -->
        </div> <!-- container -->

    </div> <!-- content -->

@endsection
