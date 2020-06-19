@extends('adminlte::page')

@section('title', 'Bobot')

@section('content_header')
<h1 class="m-0 text-dark">Bobot</h1>
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
            {!! Form::open(array('route' => ['bobot.store'],'method'=>'POST','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!}
            <div class="card-header">
                <h3 class="card-title">
                    Tambah Data Bobot</h3>

                <div class="card-tools">
                    <button type="submit" id="saveBtn" value="create" class="btn btn-primary  btn-sm btn-flat">Simpan</button>
                </div>
            </div>
            <div class="card-body">
               
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Jenis Bobot</label>
                    <div class="col-6">
                        {!! Form::select('jenis_bobot_id', \App\Jenisbobot::all()->pluck('keterangan', 'id')->toArray(), null,['class'=>'select2 form-control']) !!}
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Keterangan</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="" name="keterangan" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">GAP A</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="" name="gap_a" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">GAP B</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="" name="gap_b" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama" class="col-2 col-form-label">Nilai</label>
                    <div class="col-6">
                        <input class="form-control" type="text" value="" name="nilai" />
                    </div>
                </div>


                <!-- /.End -->
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
@stop