<style type="text/css">
   table {
            border: 1px solid #000;
            border-collapse: collapse;
        }

        table td {
            border: 1px solid #000;
            padding: 12px;
        }

         .rotate {
            white-space:nowrap;
             -webkit-transform: rotate(270deg);
             -moz-transform: rotate(270deg);
             -o-transform: rotate(270deg);
            writing-mode: lr-tb;
          }
          table td {
        border: 1px solid #000;
        padding: 12px;
    }
</style>
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">
Table 5.1. Summary of research output
</caption>
                                <thead>
                                    <th>No.</th>
                                    <th class="" style="text-align: center;">Publication<br> category</th>
                                    <th>Publication type</th>
                                    <th>Year</th>
                                    <th>Total number of items</th>
                                    <th >Number of contributing core faculty members</th>
                                    <th>Number of items jointly produced in collaboration with other institutions</th>
                                    <th>Number of items jointly produced by faculty of same university</th>
                                    <th>Number of items jointly produced by more than 3 authors</th>


                                </thead>
                                <tbody>
                                    @foreach($researchOutput as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->publicationType}}</td>
                                        <td>{{$data->publicationName}}</td>
                                        <td>{{$data->year}}</td>
                                        <td>{{$data->total_items}}</td>
                                        <td>{{$data->contributing_core_faculty}}</td>
                                        <td>{{$data->jointly_produced_other}}</td>
                                        <td>{{$data->jointly_produced_same}}</td>
                                        <td>{{$data->jointly_produced_multiple}}</td>
                                    </tr>
                                    @endforeach



                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
