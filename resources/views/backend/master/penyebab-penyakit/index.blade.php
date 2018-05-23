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
                                    <table class="table table-striped table-bordered table-hover" id="table-role" >
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Diagnosa Penyakit</th>
                                            <th>Detail</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data as $num => $item)
                                            <tr>
                                                <td>{{$num+1}}</td>
                                                <td>{{$item->nama_diagnosa_penyakit}}</td>
                                                <td>
                                                    <a href="{{url('backend/master/penyebab-penyakit/view?id=')}}{{$item->id}}" class="btn btn-info btn-xs">
                                                        <i class="fa fa-sign-in"></i>
                                                        Lihat detail
                                                    </a>

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