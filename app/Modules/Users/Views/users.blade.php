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
                                    <form action="{{ route('users.index') }}" method="get">
                                        <div class=" has-icon-left position-relative">
                                            <input type="text" class="form-control"
                                                value="{{ request()->get('search') }}" name="search" placeholder="Search">
                                            {{-- <div class="form-control-icon"><i class="fa fa-search"></i></div> --}}
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">
                                </div>
                                <div class="col-2">
                                    <a href="{{ route('users.create') }}"
                                        class="btn btn-sm btn-primary icon icon-left rounded-pill"><i
                                            class="fa fa-plus"></i> Tambah {{ $title }}</a>
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
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Kode Identitas</th>
                                            <th>Role</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = $data->firstItem(); @endphp
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->identitas }}</td>
                                                <td>{{ @$item->roleuser->sortBy('role')->pluck('role')->implode(', ') }}
                                                </td>
                                                <td>
                                                    {!! button('users.edit', $title, ['user' => $item->id]) !!}
                                                    {!! button('users.destroy', $title, ['user' => $item->id]) !!}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center"><i>No data.</i></td>
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
