@extends('adminlte::page')

@section('title', 'Detail Hasil')

@section('content_header')
<h1 class="m-0 text-dark">Detail Hasil </h1>
@stop

@section('content')
<div class="row">
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
                    Detail Hasil Perhitungan {!! $detail->penilaian !!} pada {{ $detail->tanggal}}</h3>

                <div class="card-tools">
                    <!-- <a href="{{ route('bobot.create') }}" class="btn btn-primary  btn-sm btn-flat">
                        Tambah baru Bobot
                    </a> -->
                </div>
            </div>
            <div class="card-body">


                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            <th witdh="5%">No</th>
                            <th witdh="65">Nama</th>
                            <th witdh="20%">Nilai</th>
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
        $('body').on('click', '.btn-action', function(elemen) {
            elemen.preventDefault();
            $(".btn-action").attr("disabled", true);
            // if ($(this).hasClass('btn-create')) {
            //     // showModal($(this));
            //     var urls = $(this).attr('link');
            //     window.open(urls);
            // } else 
            if ($(this).hasClass('btn-detail')) {
                var urls = $(this).attr('link');
                window.open(urls)
                // } else if ($(this).hasClass('btn-edit')) {
                //     var urls = $(this).attr('link');
                //     window.open(urls)
            } else if ($(this).hasClass('delete')) {
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
                            credentials: true,
                            method: "DELETE",
                        }).then(response => {
                            console.log(response);
                            table.draw();
                            swal2(data.status, data.message);

                        }).catch(error => {
                            table.draw();


                        });
                    }
                })
            }
            $(".btn-action").attr("disabled", false);

        });
        $(document).ajaxStart(function() {
            // Pace.restart();
        });



        function showModal(el) {
            var urls = el.attr('link'),
                title = el.attr('title');

            $('.modal-title').text(title);

            axios({
                url: urls,
                credentials: true,
                method: "GET",
            }).then(response => {
                // // console.log(response);
                $('.modal-content').html(response.data);
                // // initElem();
                $('#modal-button').text(el.hasClass('edit') ? 'Edit' : 'Simpan');
                if (el.hasClass('btn-addlink')) {
                    $('#invisible_id').val('1');

                }
                $('.modal').modal('show');

            }).catch(error => {
                console.log(error.response);
            });
        }
        $('body').on('click', '#saveBtn', function(e) {
            e.preventDefault();
            $(this).html('Sending..');
            $("#btnSubmit").attr("disabled", true);

            $.ajax({
                data: $('#my_form').serialize(),
                url: $('#my_form').attr("action"),
                type: $('#my_form').attr("method"),
                dataType: 'json',
                success: function(data) {

                    $('#my_form').trigger("reset");
                    $('.modal').modal('hide');
                    swal2("success", data.message);
                    table.draw();

                },
                error: function(data) {
                    swal2("error", data.statusText);

                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
            $("#btnSubmit").attr("disabled", false);

        });

        function swal2(types, titles) {
            Swal.fire({
                position: 'top-end',
                type: types,
                title: titles,
                showConfirmButton: false,
                timer: 2000
            })
        }
        table =
            $('#table').DataTable({
                //server-side
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{ route('tableHasildetail', ['periode' => $detail->periode_id, 'penilaian' => $detail->penilaian_id]) }}",
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
                        data: 'nilai',
                        name: 'nilai'
                    },

                    {
                        data: 'Ranking',
                        name: 'Ranking'
                    },

                ]
            });

    });
</script>
@endsection