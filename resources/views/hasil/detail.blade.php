@extends('adminlte::page')

@section('title', 'Detail Hasil')

@section('content_header')
<h1 class="m-0 text-dark">Detail Hasil Penilaian {{$dataPenilaian->keterangan}} Periode {{$dataPeriode->keterangan}} </h1>
@stop

@section('content')
<div class="row">
    <!-- Tabel Data Awal -->
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Table Data Awal </h3>

                <div class="card-tools">
                <a href="{{ route('laporanDetailHitung', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}" class='btn btn-primary btn-sm btn-flat '><i class='fas fa-fw fa-print ' aria-hidden="true"></i></a>
                </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table_dataawal1">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="40%">Atlet</th>
                            <th witdh="30%">Kriteria</th>
                            <th witdh="20%">Nilai</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Gaps -->
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Gaps (Data Awal - Nilai Profil Posisi Per Kriteria)
                    <div class="card-tools">
                        <!-- <a href="{{ route('bobot.create') }}" class="btn btn-primary  btn-sm btn-flat">
                        Tambah baru Bobot
                    </a> -->
                    </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table_gaps">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="20%">Atlet</th>
                            <th witdh="25%">Kriteria</th>
                            <th witdh="15%">Nilai Awal</th>
                            <th witdh="15%">Profil Posisi</th>
                            <th witdh="15%">Nilai GAP</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Normalisasi  -->
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Normalisasi (Hasil Dari Perbandingan Tabel Gaps dan Tabel Bobot)
                    <div class="card-tools">
                        <!-- <a href="{{ route('bobot.create') }}" class="btn btn-primary  btn-sm btn-flat">
                        Tambah baru Bobot
                    </a> -->
                    </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table_normalisasi">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="30%">Atlet</th>
                            <th witdh="20%">Kriteria</th>
                            <th witdh="20%">Nilai GAP</th>
                            <th witdh="20%">Nilai Normalisasi</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Core & Secondary  -->
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Core & Secondary (Hasil Tabel Normalisasi dipisahkan dan dikalikan per jenis kriteria )
                    <div class="card-tools">
                        <!-- <a href="{{ route('bobot.create') }}" class="btn btn-primary  btn-sm btn-flat">
                        Tambah baru Bobot
                    </a> -->
                    </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table_coresecondary">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="25%">Atlet</th>
                            <th witdh="20%">Kriteria</th>
                            <th witdh="15%">Nilai Normalisasi</th>
                            <th witdh="15%">Jenis Kriteria</th>
                            <th witdh="15%">Persentase Jenis Kriteria</th>

                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tabel Hasil -->
    <div class="col-12">
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Tabel Hasil Perhitungan (Hasil Dari Penjumlahan Nilai Core + Nilai Secondary Per Atlet)
                    <div class="card-tools">
                        <!-- <a href="{{ route('bobot.create') }}" class="btn btn-primary  btn-sm btn-flat">
                        Tambah baru Bobot
                    </a> -->
                    </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table_hasil">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="25%">Nama</th>
                            <th witdh="20%">Core</th>
                            <th witdh="20%">Secondary</th>
                            <th witdh="20%">Nilai Akhir</th>
                            <th witdh="10%">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@stop

@section('js')
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        table =
            $('#table_hasil').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableHasildetail', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}",
                    "type": "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'atlet.nama',
                        name: 'atlet.nama'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },

                    {
                        data: 'nilai',
                        name: 'nilai'
                    },

                    {
                        data: 'nilai',
                        name: 'nilai'
                    },

                    {
                        data: 'ranking',
                        name: 'ranking'
                    },

                ]
            });

        tabledata =
            $('#table_dataawal1').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableDataawal', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}",
                    "type": "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'atlet.nama',
                        name: 'atlet.nama'
                    },


                    {
                        data: 'kriteria.keterangan',
                        name: 'Kriteria'
                    },

                    {
                        data: 'nilai',
                        name: 'nilai'
                    },


                ]
            });

        tablegaps =
            $('#table_gaps').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableGaps', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}",
                    "type": "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },


                    {
                        data: 'keterangan',
                        name: 'Kriteria'
                    },

                    {
                        data: 'nilaiawal',
                        name: 'nilaiawal'
                    },

                    {
                        data: 'profilposisi',
                        name: 'profilposisi'
                    },

                    {
                        data: 'nilaihasilgap',
                        name: 'nilaihasilgap'
                    },



                ]
            });

        tablenormalisasi =
            $('#table_normalisasi').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableNormalisasi', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}",
                    "type": "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },

                    {
                        data: 'keterangan',
                        name: 'Kriteria'
                    },

                    {
                        data: 'g_a_p_s',
                        name: 'g_a_p_s'
                    },

                    {
                        data: 'normaisasi_bobots',
                        name: 'normaisasi_bobots'
                    },

                ]
            });


        tablecoresecondary =
            $('#table_coresecondary').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableCoresecondary', ['penilaian' => $penilaianID,'periode' => $periodeID ]) }}",
                    "type": "GET"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },

                    {
                        data: 'nama',
                        name: 'nama'
                    },

                    {
                        data: 'kriterias',
                        name: 'kriterias'
                    },

                    {
                        data: 'nilai',
                        name: 'nilai'
                    },

                    {
                        data: 'keterangan',
                        name: 'keterangan'
                    },

                    {
                        data: 'presentase',
                        name: 'presentase'
                    },



                ]
            });




    });
</script>
@endsection