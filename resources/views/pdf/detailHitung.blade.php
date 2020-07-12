<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color: #333;
            text-align: left;
            font-size: 18px;
            margin: 0;
        }

        .container {
            margin: 0 auto;
            margin-top: 35px;
            padding: 40px;
            width: 100%;
            height: auto;
            background-color: #fff;
            word-wrap: break-word;

        }

        p {
            margin-top: 15px;
            margin-bottom: 15px;
        }

        table {
            border: 1px solid #333;
            border-collapse: collapse;
            margin: 0 auto;
            width: 100%;
            margin-bottom: 15px;
        }

        td,
        tr,
        th {
            padding: 12px;
            border: 1px solid #333;
            /* width:185px; */
        }

        th {
            background-color: #f0f0f0;
        }

        h4,
        p {
            margin: 0px;
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h5>
                Laporan Detail Hitung {{$dataPenilaian->keterangan}} <br /> Periode {{$dataPeriode->keterangan}}
            </h5>
        </center>
        <p>Table Data Awal</p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kreteria</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($tableDataAwal as $p)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{$p->atlet->nama}}</td>
                    <td>{{$p->penilaian->keterangan}}</td>
                    <td>{{$p->nilai}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
        <p>Tabel Gaps (Data Awal - Nilai Profil Posisi Per Kriteria)
        </p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kreteria</th>
                    <th>Nilai Awal</th>
                    <th>Profile Posisi</th>
                    <th>Nilai GAP</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($tableGaps as $a)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->keterangan }}</td>
                    <td>{{ $a->nilaiawal }}</td>
                    <td>{{ $a->profilposisi }}</td>
                    <td>{{ $a->nilaihasilgap }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
        <p>Tabel Normalisasi (Hasil Dari Perbandingan Tabel Gaps dan Tabel Bobot)
        </p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kreteria</th>
                    <th>Nilai GAPS</th>
                    <th>Nilai Normalisasi</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($tableNormalisasi as $a)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->keterangan }}</td>
                    <td>{{ $a->g_a_p_s }}</td>
                    <td>{{ $a->normaisasi_bobots }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
        <p>Tabel Core & Secondary (Hasil Tabel Normalisasi dipisahkan dan dikalikan per jenis kriteria )
        </p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kreteria</th>
                    <th>Nilai</th>
                    <th>Jenis Kreteria</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($tableCore as $a)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->kriterias }}</td>
                    <td>{{ $a->nilai }}</td>
                    <td>{{ $a->keterangan }}</td>
                    <td>{{ $a->presentase }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
        <p>Tabel Hasil Perhitungan (Hasil Dari Penjumlahan Nilai Core + Nilai Secondary Per Atlet)
        </p>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Core</th>
                    <th>SecondCore</th>
                    <th>Nilai Akhir</th>
                    <th>Rangking</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($tableHasil as $a)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $a->atlet->nama }}</td>
                    <td>{{ $a->nilai }}</td>
                    <td>{{ $a->Core }}</td>
                    <td>{{ $a->SecondCore }}</td>
                    <td>{{ $a->ranking }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
    </div>
</body>

</html>