@if(count($kesimpulan) > 0)
    <div class="alert alert-danger" style="text-align: left">
        Anda memiliki diagnosa penyakit :
        <table class="table table-bordered">
            <tr>
                <thead>
                <th>Nama Penyakit</th>
                <th>Prosentase</th>
                </thead>
            </tr>
            <tbody>

            @foreach($kesimpulan as $key => $item)
                <tr>
                    <td>{{$item['diagnosa']}}</td>
                    <td>{{$item['nilai']}} %</td>
                </tr>

            @endforeach
            </tbody>
        </table>

    </div>
@else
    <div class="alert alert-success">Anda tidak memiliki diagnosa penyakit apapun!</div>
@endif