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
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">
Table 7.5. Business schools’ resources
</caption>
                                <thead>
                                    
                                </thead>
                               <tbody>
                                    @foreach($BIResources as $data)
                                    <tr>
                                        <td>{{$data->facilityType}}</td>
                                        <td>{{$data->facilityName}}</td>
                                        <td>{{$data->remark}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>