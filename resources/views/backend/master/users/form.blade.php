<div id="result-form-konten"></div>
<form onsubmit="return false;" id="form-konten" class='form-horizontal'>
    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Username</label>
        <div class='col-sm-9 col-xs-12'>
            <input type="text" name="username" class="form-control" value="{{$data->username}}" required="">
        </div>
    </div>
    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Password</label>
        <div class='col-sm-9 col-xs-12'>
            <input type="password" name="password" class="form-control" value="{{$data->password}}" required="">
        </div>
    </div>

    <div class='form-group'>
        <label for='nama' class='col-sm-2 col-xs-12 control-label'>Peran</label>
        <div class='col-sm-9 col-xs-12'>
            <select name="role_id" class="form-control">
                @foreach($roleOption as $num => $item)
                    <option value="{{$item->id}}" @if(!is_null($data)) @if($item->id == $data->role_id) selected="selected" @endif @endif >{{$item->nama_role}}</option>
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
    <input type='hidden' name='_token' value='{{ csrf_token() }}'>
</form>

<script>
    $(document).ready(function () {
        $('#form-konten').submit(function () {
            var data = getFormData('form-konten');
            ajaxTransfer('/backend/master/users/save', data, '#result-form-konten');
        })
    })
</script>
