@extends('adminlte::page')

@section('title', 'Hitung')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Hitung</h1>
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
            <!-- {!! Form::open(array('route' => ['hitung.store'],'method'=>'POST','role' =>
            'form','autocomplete'=>'off', 'id' => 'my_form','enctype'=>"multipart/form-data")) !!} -->
            <div class="card-header">
                <h3 class="card-title">
                    Hitung</h3>

                <div class="card-tools">
                    <button class="btn btn-success btn-action btn-sm btn-flat btn-hitung">Hitung Data</button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="form-group row col-6">
                        <label for="nama" class="col-2 col-form-label">Periode</label>
                        <div class="col-6">
                            {!! Form::select('periode_id', \App\Periode::all()->pluck('keterangan', 'id')->toArray(), null,['class'=>'select2 form-control periode datarefresh']) !!}
                        </div>
                    </div>
                    <div class="form-group row  col-6">
                        <label for="nama" class="col-2 col-form-label">Penilaian</label>
                        <div class="col-6">
                            {!! Form::select('penilaian_id', \App\Penilaian::all()->pluck('keterangan', 'id')->toArray(), null,['class'=>'select2 form-control penilaian datarefresh']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="form-group">
                            <label for="nama" class="col-12 col-form-label">Atlet</label>
                            <div class="col-12">
                                {!! Form::select('atlet_id', \App\Atlet::all()->pluck('nama', 'id')->toArray(), null,['class'=>'select2 form-control atlet']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="nama" class="col-12 col-form-label">Kriteria</label>
                            <div class="col-12 ">
                                <select class="select2 form-control kriteria_id Kriteria-content" name="kriteria_id">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="nama" class="col-12 col-form-label">Nilai</label>
                            <div class="col-12">
                                <input class="form-control nilaiInput" type="number" value="" name="nilai" id="dataNilai" />
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <label for="nama" class="col-12 col-form-label"> ACTION</label>
                            <div class="col-12">
                                <button class="btn btn-success btn-detail btn-action btn-sm btn-flat ">Tambah Data</button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.End -->
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="40%">Atlet</th>
                            <th witdh="30%">Kriteria</th>
                            <th witdh="20%">Nilai</th>
                            <th witdh="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>

            <!-- {!! Form::close() !!} -->

        </div>

    </div>
</div>
@stop

@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    $(function() {
        var dataTemp = [];
        var table = $('#table').DataTable({
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'atlet.nama',
                    name: 'Atlet'
                },
                {
                    data: 'kriteria.keterangan',
                    name: 'Kriteria'
                },

                {
                    data: 'nilai',
                    name: 'nilai'
                },

                {
                    data: 'action',
                    name: 'action'
                },

            ]
        });

        function refeshTable() {
            var periodes = $('.periode').val();
            var penilaian = $('.penilaian').val();

            $.ajax({
                url: "../dataTableInsert/" + periodes + "/" + penilaian,
                type: 'GET',
                success: function(data) {
                    var table = $('#table').DataTable();
                    table.clear();
                    table.rows.add(data.data);
                    table.draw();
                    console.log(data)
                }
            });
        }
        $(".datarefresh ").change(function() {
            refeshTable()
        });
        $('body').on('click', '.btn-hitung', function(elemen) {
            var periodes = $('.periode').val();
            var penilaian = $('.penilaian').val();
            window.open("{{url('/')}}/home/detailHasil/" + periodes + "/" + penilaian)
        });
        $('body').on('click', '.btn-action', function(elemen) {
            elemen.preventDefault();
            var selectedText = $(".penilaian").find("option:selected").text();
            var selectedValue = $('.penilaian').val();
            var selectedText1 = $(".atlet").find("option:selected").text();
            var selectedValue1 = $('.atlet').val();
            var selectedText2 = $(".kriteria_id").find("option:selected").text();
            var selectedValue2 = $('.kriteria_id').val();
            var nilaiInput = $('.nilaiInput').val();
            var periode = $('.periode').val();
            var dataObject = {
                atlet: selectedText1,
                atlet_id: selectedValue1,
                nilai: nilaiInput,
                penilaian: selectedText,
                penilaian_id: selectedValue,
                nilai: nilaiInput,
                kriteria: selectedText2,
                kriteria_id: selectedValue2,
                periode_id: periode
            };

            if (nilaiInput != "") {
                dataTemp.push(dataObject);
                console.log(dataTemp)
                $('.nilaiInput').val("");
                axios({
                    url: "{{route('hitung.store')}}",
                    method: "post",
                    data: dataObject
                }).then(response => {
                    console.log(response);
                    refeshTable()
                }).catch(error => {
                    console.log(error)
                    refeshTable()

                });

            }
        });
        $('body').on('click', '.btn-action', function(elemen) {
            elemen.preventDefault();
            $(".btn-action").attr("disabled", true);
            // if ($(this).hasClass('btn-create')) {
            //     // showModal($(this));
            //     var urls = $(this).attr('link');
            //     window.open(urls);
            // } else if ($(this).hasClass('btn-detail')) {
            //     var urls = $(this).attr('link');
            //     window.open(urls)
            // } else if ($(this).hasClass('btn-edit')) {
            //     var urls = $(this).attr('link');
            //     window.open(urls)
            // } else 
            if ($(this).hasClass('delete')) {
                const urlsdelete = $(this).attr('link');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delete this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios({
                            url: urlsdelete,
                            method: "GET",
                        }).then(response => {
                            console.log(response);
                            refeshTable()
                        }).catch(error => {
                            refeshTable()
                        });
                    }
                })
            }
            $(".btn-action").attr("disabled", false);

        });
        $(".penilaian").change(function() {
            var selectedText = $(this).find("option:selected").text();
            var selectedValue = $(this).val();
            const data = {};
            data["id"] = $(this).val();
            axios({
                url: "{{route('dataDropdown')}}",
                credentials: true,
                method: "POST",
                data: data
            }).then(response => {
                console.log(response.data);
                $(".Kriteria-content").html(response.data.data)
            }).catch(error => {
                console.log(error)

            });
        });

    });
</script>
@endsection