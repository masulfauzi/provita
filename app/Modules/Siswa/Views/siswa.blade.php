@extends('layouts.app')

@section('page-css')
@endsection

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
                                <li class="breadcrumb-item active">{{ $title }}</li>
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
                        <div class="card-header pb-0">
                            <h4 class="header-title">Tabel Data {{ $title }}</h4>
                            <div class="row">
                                <div class="col-3">
                                    <form action="{{ route('siswa.index') }}" method="get">
                                        <div class=" has-icon-left position-relative">
                                            <input type="text" class="form-control"
                                                value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">
                                </div>
                                <div class="col-2">
                                    {!! button('siswa.create', $title) !!}  
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @include('include.flash')
                            <div class="table-responsive mb-2">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th width="15">No</th>
                                            <td>Nisn</td>
								<td>Nis</td>
								<td>Nama</td>
								<td>Jenis Kelamin</td>
								<td>Nik</td>
								{{-- <td>Sekolah Asal</td>
								<td>Sekolah</td>
								<td>Tempat Lahir</td>
								<td>Tgl Lahir</td>
								<td>Agama</td>
								<td>Desa</td>
								<td>Alamat</td>
								<td>Alat Transportasi</td>
								<td>Jenis Tinggal</td> --}}
								<td>No Telp</td>
								<td>Email</td>
								<td>No Registrasi Akta Lahir</td>
								
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = $data->firstItem(); @endphp
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->nisn }}</td>
									<td>{{ $item->nis }}</td>
									<td>{{ $item->nama }}</td>
									<td>{{ $item->jenis_kelamin }}</td>
									<td>{{ $item->nik }}</td>
									{{-- <td>{{ $item->sekolah_asal }}</td>
									<td>{{ $item->id_sekolah }}</td>
									<td>{{ $item->tempat_lahir }}</td>
									<td>{{ $item->tgl_lahir }}</td>
									<td>{{ $item->agama }}</td>
									<td>{{ $item->id_desa }}</td>
									<td>{{ $item->alamat }}</td>
									<td>{{ $item->alat_transportasi }}</td>
									<td>{{ $item->jenis_tinggal }}</td> --}}
									<td>{{ $item->no_telp }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->no_registrasi_akta_lahir }}</td>
									
                                                <td>
                                                    {!! button('siswa.show','', $item->id) !!}
                                                    {!! button('siswa.edit', $title, $item->id) !!}
                                                    {!! button('siswa.destroy', $title, $item->id) !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="19" class="text-center"><i>No data.</i></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            {{ $data->links() }}



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