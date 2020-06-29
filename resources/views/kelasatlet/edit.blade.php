@extends('adminlte::page')

@section('title', 'Edit Data')

@section('content_header')
<h1 class="m-0 text-dark">Edit Data Kelas Atlet</h1>
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
            {!! Form::open(array('route' => ['kelasatlet.update',$kelasatlet->id],'method'=>'PATCH','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!}
            <div class="card-header">
                <h3 class="card-title">
                    Edit Data Kelas Atlet</h3>

                <div class="card-tools">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary  btn-sm btn-flat">Simpan</button>

                </div>
            </div>
            <div class="card-body">
            <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Atlet</label>
                    <div class="col-6">
                    {!! Form::select('atlet_id', \App\Atlet::all()->pluck('nama', 'id')->toArray(), $kelasatlet->atlet_id,['class'=>'select2 form-control atlet']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Kelas</label>
                    <div class="col-6">
                    {!! Form::select('penilaian_id', \App\Penilaian::all()->pluck('keterangan', 'id')->toArray(), $kelasatlet->penilaian_id,['class'=>'select2 form-control penilaian datarefresh']) !!}
                    </div>
                </div>

                <!-- /.End -->

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop