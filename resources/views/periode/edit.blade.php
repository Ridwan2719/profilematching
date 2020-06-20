@extends('adminlte::page')

@section('title', 'Periode')

@section('content_header')
<h1 class="m-0 text-dark">Periode</h1>
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
            {!! Form::open(array('route' => ['periode.update',$periode->id],'method'=>'PATCH','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!}
            <div class="card-header">
                <h3 class="card-title">
                    Data Periode</h3>

                <div class="card-tools">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary  btn-sm btn-flat">Simpan</button>

                </div>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Periode</label>
                    <div class="col-6">
                        <input class="form-control" type="date" value="{{$periode->keterangan}}" name="keterangan" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Status</label>
                    <div class="col-6">
                        {!! Form::select('status', ["Aktif","Non-Aktif"], $periode->status,['class'=>'select2 form-control']) !!}
                    </div>
                </div>

                <!-- /.End -->

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop