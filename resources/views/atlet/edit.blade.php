@extends('adminlte::page')

@section('title', 'Atlet Edit')

@section('content_header')
<h1 class="m-0 text-dark">Atlet</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> ada masalah input data!.
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            {!! Form::open(array('route' => ['atlet.update',$atlet->id],'method'=>'PATCH','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!}
            <div class="card-header">
                <h3 class="card-title">
                    Data Atlet</h3>

                <div class="card-tools">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary  btn-sm btn-flat">Simpan</button>

                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Nama</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{$atlet->nama}}" name="nama" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Kelas</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{$atlet->kelas}}" name="kelas" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Umur</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="{{$atlet->umur}}" name="umur" />
                    </div>
                </div>

                <!-- /.End -->

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop