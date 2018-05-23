

<div id="result-form-konten"></div>
<form onsubmit="return false;" id="form-konten" class='form-horizontal'>
    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Gejala Klinis</label>
        <div class='col-sm-9 col-xs-12'>
            <span class="form-control">{{$gejalaKlinis->nama_gejala_klinis}}</span>
        </div>
    </div>

    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Gejala Fisik</label>
        <div class='col-sm-9 col-xs-12'>
            <select name="id_gejala_fisik" class="form-control">
                @foreach($gejalaFisik as $num => $item)
                    <option value="{{$item->id}}" @if(!is_null($data)) @if($item->id == $data->gejala_fisik_id) selected="selected" @endif @endif >{{$item->nama_gejala_fisik}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class='form-group'>
        <label class='col-sm-2 col-xs-12 control-label'></label>
        <div class='col-sm-9 col-xs-12'>
            <input type="submit" class="btn btn-primary" value="Simpan Data">
        </div>
    </div>

    <input type='hidden' name='id' value='{{ $data->id }}'>
    <input type="hidden" name="id_gejala_klinis" value="{{$gejalaKlinis->id}}">
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
</form>

<script>
    $(document).ready(function () {
        $('#form-konten').submit(function () {
            var data = getFormData('form-konten');
            ajaxTransfer('/backend/master/penyebab-klinis/save', data, '#result-form-konten');
        })
    })
</script>
