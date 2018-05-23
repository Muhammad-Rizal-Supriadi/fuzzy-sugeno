<div id="result-form-konten"></div>
<form onsubmit="return false;" id="form-konten" class='form-horizontal'>
    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Nama Penyakit</label>
        <div class='col-sm-9 col-xs-12'>
            <input type="text" name="nama_diagnosa_penyakit" class="form-control" value="{{$data->nama_diagnosa_penyakit}}" required="">
        </div>
    </div>

    <div class='form-group'>
        <label class='col-sm-2 col-xs-12 control-label'></label>
        <div class='col-sm-9 col-xs-12'>
            <input type="submit" class="btn btn-primary" value="Simpan Data">
        </div>
    </div>

    <input type='hidden' name='id' value='{{ $data->id }}'>
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
</form>

<script>
    $(document).ready(function () {
        $('#form-konten').submit(function () {
            var data = getFormData('form-konten');
            ajaxTransfer('/backend/master/diagnosa-penyakit/save', data, '#result-form-konten');
        })
    })
</script>
