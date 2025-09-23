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
                    <a href="{{ route('siswa.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary mb-1"><i class="fa fa-arrow-left"></i> Kembali </a>
                </div>
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('siswa.index') }}">{{ $title }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $siswa->nama }}</li>
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
                            <h4 class="header-title">Detail Data {{ $title }}: {{ $siswa->nama }}</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <div class="row">
                                    <div class='col-lg-2'><p>Nisn</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nisn }}</p></div>
									<div class='col-lg-2'><p>Nis</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nis }}</p></div>
									<div class='col-lg-2'><p>Nama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nama }}</p></div>
									<div class='col-lg-2'><p>Jenis Kelamin</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->jenis_kelamin }}</p></div>
									<div class='col-lg-2'><p>Nik</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->nik }}</p></div>
									<div class='col-lg-2'><p>Sekolah Asal</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->sekolah_asal->sekolah }}</p></div>
									<div class='col-lg-2'><p>Sekolah</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->sekolah->nama_sekolah }}</p></div>
									<div class='col-lg-2'><p>Tempat Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tempat_lahir }}</p></div>
									<div class='col-lg-2'><p>Tgl Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->tgl_lahir }}</p></div>
									<div class='col-lg-2'><p>Agama</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->agama->agama }}</p></div>
									<div class='col-lg-2'><p>Desa</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->desa->nama_desa }}</p></div>
									<div class='col-lg-2'><p>Alamat</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->alamat }}</p></div>
									<div class='col-lg-2'><p>Alat Transportasi</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->alat_transportasi->transportasi }}</p></div>
									<div class='col-lg-2'><p>Jenis Tinggal</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->jenis_tinggal->jenis_tinggal }}</p></div>
									<div class='col-lg-2'><p>No Telp</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_telp }}</p></div>
									<div class='col-lg-2'><p>Email</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->email }}</p></div>
									<div class='col-lg-2'><p>No Registrasi Akta Lahir</p></div><div class='col-lg-10'><p class='fw-bold'>{{ $siswa->no_registrasi_akta_lahir }}</p></div>
									
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