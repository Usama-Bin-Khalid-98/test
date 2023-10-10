
<div class="box-body table-responsive">                       
    <p style="text-align: center;color: red">
        Table 2.6. Mapping of POs and PLOs
    </p>
            @foreach($scopeOfAcredation as $scope)
            <h4>{{$scope->programName}}</h4>
            <table   class="table table-bordered table-striped ">
                <tr>    
                    <th>POs/PLOs</th>
                    @for($i = 1; $i <= 5; $i++)
                        <th>PLO{{$i}}</th>
                    @endfor
                </tr>
                @for($i = 1; $i <= 5; $i++)
                    <tr>
                        <th>PO{{$i}}</th>
                        @for($j = 1; $j <= 5; $j++)
                            <td>@if(@$ploMappings[$scope->programName]['PO' . $i][$j])<i class="fa fa-check"></i> @endif</td>
                        @endfor
                    </tr>  
                @endfor
                </table>
            @endforeach
        
        

    
</div>