
<div class="row">
    <div class="col-lg-4">
        <div class="alert alert-success">
            <p><h3>Fuzzy Value</h3></p>
            @foreach($findMethod as $item)
                <table class="table table-bordered">
                    <tr>
                        <td width="50%">{{$item['fuzzy_status']}}</td>
                        <td width="5%">=</td>
                        <td>{{$item['fuzzy_value']}}</td>
                    </tr>
                </table>
            @endforeach
        </div>
    </div>
    <div class="col-lg-4">
        <div class="alert alert-success">
            <p><h3>Fuzzy Centroid Method</h3></p>
            @foreach($findSugenoMethod as $item)
                <table class="table table-bordered">
                    <tr>
                        <td width="40%">{{$item['fuzzy_value']}}</td>
                        <td width="10%">x</td>
                        <td width="40">{{$item['sugeno_value']}}</td>
                    </tr>
                </table>
            @endforeach
            <p><h3>Crips Index :{{$cripsIndex}}</h3></p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="alert alert-success">

            <p><h3>Result :</h3></p>
            <table class="table table-bordered">
                <tr>
                    <td width="50%">{{$result['max_status']}}</td>
                    <td width="5%">=</td>
                    <td>{{$result['max_value']}}</td>
                </tr>
            </table>
        </div>

    </div>
</div>
