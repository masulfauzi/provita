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
                                    <form action="{{ route('desa.index') }}" method="get">
                                        <div class=" has-icon-left position-relative">
                                            <input type="text" class="form-control"
                                                value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">
                                </div>
                                <div class="col-2">
                                    {!! button('desa.create', $title) !!}  
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
                                            <td>Kecamatan</td>
								<td>Nama Desa</td>
								
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = $data->firstItem(); @endphp
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->id_kecamatan }}</td>
									<td>{{ $item->nama_desa }}</td>
									
                                                <td>
                                                    {!! button('desa.show','', $item->id) !!}
                                                    {!! button('desa.edit', $title, $item->id) !!}
                                                    {!! button('desa.destroy', $title, $item->id) !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center"><i>No data.</i></td>
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