@extends('layout.main')
@section('title', $title)
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Penyebab Penyakit</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>

                <li>
                    <a href="#">Master</a>
                </li>


                <li class="active">
                    <a>Penyebab Penyakit</a>
                </li>
            </ol>
        </div>
        <div class="col-lg-2"></div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <div class="ibox-content">

                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered table-striped">
                                        <tr>
                                            <td width="20%">Nama Gejala Klinis</td>
                                            <td width="5%">:</td>
                                            <td>{{$gejalaKlinis->nama_gejala_klinis}}</td>
                                        </tr>

                                        <tr>
                                            <td width="20%">Jumlah Relasi</td>
                                            <td width="5%">:</td>
                                            <td>{{count($data)}} Relasi</td>
                                        </tr>
                                    </table>

                                    <br><br>

                                    <a onclick="loadModal(this)" target="/backend/master/penyebab-klinis/add?id_klinis={{$gejalaKlinis->id}}" class="btn btn-primary" title="Tambah Data"><i
                                                class="glyphicon glyphicon-plus"></i> Tambah Data</a>
                                    <br><br>
                                    <table class="table table-striped table-bordered table-hover" id="table-role" >
                                        <thead>
                                        <tr>
                                            <th width="5%">No</th>
                                            <th>Nama Gejala Klinis</th>
                                            <th>Nama Gejala Fisik Penyebab</th>
                                            <th>Opsi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $num => $item)
                                            <tr>
                                                <td class="center">{{$num+1}}</td>
                                                <td>{{$item->getGejalaKlinis->nama_gejala_klinis}}</td>
                                                <td>{{$item->getGejalaFisik->nama_gejala_fisik}}</td>
                                                <td align="center">
                                                    <a onclick="loadModal(this)" target="/backend/master/penyebab-klinis/add?id_klinis={{$gejalaKlinis->id}}" data="id={{$item->id}}}"
                                                       class="btn btn-primary btn-xs glyphicon glyphicon-pencil" title="Ubah Data"></a>

                                                    <a onclick="deleteData({{$item->id}})" class="btn btn-danger btn-xs glyphicon glyphicon-trash"
                                                       title="Hapus Data"></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script>
        function deleteData(id) {
            var data = new FormData();
            data.append('id', id);

            modalConfirm("Konfirmasi", "Apakah anda yakin akan menghapus data?", function () {
                ajaxTransfer("/backend/master/penyebab-klinis/delete", data, "#modal-output");
            })
        }


        var table = $('#table-role');
        table.dataTable({
            pageLength: 10,
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            columnDefs: [
                {"targets": 0, "orderable": false},
                // {"targets": 1, "visible": false, "searchable": false},
            ],
            order: [[0, "asc"]],
            buttons: [
                {extend: 'copy'},
                {extend: 'csv', title: 'Tipe Fasilitas'},
                {extend: 'excel', title: 'Tipe Fasilitas'},
                {extend: 'pdf', title: 'Tipe Fasilitas'},
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        });
    </script>
@endsection

@endsection