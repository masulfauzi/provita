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
                    <a href="{{ route('nasabah.index') }}" class="btn btn-sm icon icon-left btn-outline-secondary mb-1"><i
                            class="fa fa-arrow-left"></i> Kembali </a>
                </div>
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('nasabah.index') }}">{{ $title }}</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $nasabah->nama }}</li>
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
                            <h4 class="header-title">Detail Data {{ $title }}: {{ $nasabah->nama }}</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <div class="row">
                                        <div class='col-lg-2'>
                                            <p>Nama Nasabah</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->nama_nasabah }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>No Hp</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->no_hp }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Nik</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->nik }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Alamat</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->alamat }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Email</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->email }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Tgl Lahir</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->tgl_lahir }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Jenis Kelamin</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->jenisKelamin->jenis_kelamin }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Tgl Daftar</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->tgl_daftar }}</p>
                                        </div>
                                        <div class='col-lg-2'>
                                            <p>Is Aktif</p>
                                        </div>
                                        <div class='col-lg-10'>
                                            <p class='fw-bold'>{{ $nasabah->is_aktif }}</p>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!--- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Data Rekening Nasabah {{ $nasabah->nama_nasabah }}</h4>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-2">
                                    <div class="table-responsive mb-2">
                                        <table class="table mb-0">
                                            <thead>
                                                <tr>
                                                    <th width="15">No</th>
                                                    <td>No. Rekening</td>

                                                    <th width="20%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $no = 1; @endphp
                                                @forelse ($rekening as $item_rekening)
                                                    <tr>
                                                        <td>{{ $no++ }}</td>
                                                        <td>{{ $item_rekening->no_rekening }}</td>

                                                        <td>
                                                            {!! button('rekening.show', '', $item_rekening->id) !!}
                                                            {!! button('rekening.edit', $title, $item_rekening->id) !!}
                                                            {!! button('rekening.destroy', $title, $item_rekening->id) !!}
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="11" class="text-center"><i>No data.</i></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
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
