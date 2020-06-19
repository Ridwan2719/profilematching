@extends('adminlte::page')

@section('title', 'Penilaian')

@section('content_header')
<h1 class="m-0 text-dark">Penilaian</h1>
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
            {!! Form::open(array('route' => ['penilaian.store'],'method'=>'POST','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!}
            <div class="card-header">
                <h3 class="card-title">
                    Data Penilaian</h3>

                <div class="card-tools">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary  btn-sm btn-flat">Simpan</button>

                </div>
            </div>
            <div class="card-body">


                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Keterangan</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="" name="keterangan" />
                    </div>
                </div>

                <!-- /.End -->
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop