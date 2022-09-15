@extends('layouts.app')
@section('third_party_stylesheets')
<link rel="stylesheet" href="{{asset('css/dataTables.bootstrap4.min.css')}}">
@endsection
@section('content')
<div class="container-fluid">

    <!-- Content Header (Page header) -->
    <div class="content-header">

        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Location Management</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Location Management</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">List of Locations</h5>

                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{route('location.create')}}" style="margin-right: 20px;">Add New Location</a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                    </div>
                </div>
                <div class="card-body table-responsive p-3">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <h6>{{ $message }}</h6>
                    </div>
                    @endif
                    @if ($message = Session::get('danger'))
                    <div class="alert alert-danger">
                        <h6>{{ $message }}</h6>
                    </div>
                    @endif
                    <table id="table" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Location Name</th>
                                <th>Zone</th>
                                <th>View</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($location as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->locationname}}</td>
                                <td>{{$data->zone}}</td>
                                <form action="{{ route('location.destroy', $data->id)}}" method="POST">
                                    <td>
                                        <a data-toggle="modal" id="mediumButton" data-target="#modal-lg" data-attr="{{ route('location.show', $data->id) }}" title="show" class="btn btn-success">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('location.edit', $data->id)}}" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit</a>
                                    </td>
                                    <td>
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit"><i class="fas fa-trash"></i> Delete</button>
                                    </td>
                                </form>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Locations</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="mediumBody">
                                    <div>
                                        <!-- the result to be displayed apply here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@include('scripts.table')
@include('scripts.modal')
@endsection