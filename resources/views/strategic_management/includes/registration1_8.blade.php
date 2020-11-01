
<div class="box-body table-responsive">
    <table   class="table table-bordered table-striped ">
        <caption style="text-align: center;color: red">Table 1.7. Mission Vision</caption>
        <thead>
        <th>Mission</th>
        <th>Vision</th>
        <th>Date of mission approval</th>
        <th>Date of vision approval</th>
        </thead>
        <tbody>
        @foreach($mission as $data)
            <tr>
                <td>{!!$data->mission!!}</td>
                <td>{!!$data->vision!!}</td>
                <td>{{$data->mission_approval}}</td>
                <td>{{$data->vision_approval}}</td>
            </tr>
        @endforeach

        </tbody>
        <tfoot></tfoot>



    </table>
</div>