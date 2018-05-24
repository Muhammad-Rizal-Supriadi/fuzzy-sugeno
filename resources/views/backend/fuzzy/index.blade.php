@extends('layout.main')
@section('title', $title)
@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>{{$title}}</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{url('/')}}">Home</a>
                </li>

                <li>
                    <a href="#">Master</a>
                </li>


                <li class="active">
                    <a>{{$title}}</a>
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
                                            <input type='hidden' name='_token' value='{{ csrf_token() }}'>
                                            <tr>
                                                <td width="15%">Tinggi </td>
                                                <td width="5%">:</td>
                                                <td><input type="text" name="hight" required=""></td>
                                            </tr>
                                            <tr>
                                                <td width="15%">Berat </td>
                                                <td width="5%">:</td>
                                                <td><input type="text" name="weight" required=""></td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <input type="submit" class="btn btn-primary" value="Proses">
                                                </td>
                                            </tr>


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
                ajaxTransfer('/backend/fuzzy/proses', data, '#result');
            })
        })
    </script>
@endsection

@endsection