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
                                    <form action="{{ route('sekolah.index') }}" method="get">
                                        <div class=" has-icon-left position-relative">
                                            <input type="text" class="form-control"
                                                value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">
                                </div>
                                <div class="col-2">
                                    {!! button('sekolah.create', $title) !!}  
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
                                            <td>Npsn</td>
								<td>Nama Sekolah</td>
								<td>Alamat</td>
								<td>No Telp</td>
								<td>Jenjang</td>
								
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = $data->firstItem(); @endphp
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->npsn }}</td>
									<td>{{ $item->nama_sekolah }}</td>
									<td>{{ $item->alamat }}</td>
									<td>{{ $item->no_telp }}</td>
									<td>{{ $item->id_jenjang }}</td>
									
                                                <td>
                                                    {!! button('sekolah.show','', $item->id) !!}
                                                    {!! button('sekolah.edit', $title, $item->id) !!}
                                                    {!! button('sekolah.destroy', $title, $item->id) !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center"><i>No data.</i></td>
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