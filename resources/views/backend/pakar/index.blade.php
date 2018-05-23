@extends('layout.main')
@section('title', $title)
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Gejala Fisik</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>

                <li>
                    <a href="#">Master</a>
                </li>


                <li class="active">
                    <a>Gejala Fisik</a>
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

                                    <table class="table table-bordered table-striped table-hover">
                                    <tr>
                                        <td width="15%">Nama Pengguna </td>
                                        <td width="5%">:</td>
                                        <td>{{Session::get('activeUser')->username}}</td>
                                    </tr>



                                    </table>

                                    <br><br>

                                    <form onsubmit="return false;" id="form-konten" class='form-horizontal' enctype="multipart/form-data">
                                        <table class="table table-bordered table-striped table-hover">
                                            <tr>
                                                <td width="15%">Treshold </td>
                                                <td width="5%">:</td>
                                                <td><input type="number" name="treshold" required=""></td>
                                            </tr>



                                        </table>

                                        <table class="table table-hover table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Gejala Fisik</th>
                                                <th>Respon</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $num => $item)
                                                <tr>
                                                    <td class="center">{{$num+1}}</td>
                                                    <td>Apakah anda {{$item->nama_gejala_fisik}}</td>
                                                    <td>
                                                        <input type="checkbox" name="response[]" value="{{$item->id}}"> Ya
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr>
                                                <td colspan="3" align="center">
                                                    <input type="submit" class="btn btn-primary" value="Proses">
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </form>

                                    <br><br>
                                    <div id="result"></div>
                                    <br><br>




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
        $(document).ready(function () {
            $('#form-konten').submit(function () {
                var data = getFormData('form-konten');
                ajaxTransfer('/backend/pakar/sistem-pakar/proses', data, '#result');
            })
        })
    </script>
@endsection

@endsection