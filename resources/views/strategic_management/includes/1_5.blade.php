
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;">Table 1.5. Affiliations of any external (academic and corporate), national or international members</caption>
                                <thead>
                                    <th>Name of member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Name of statutory body</th>
                                </thead>
                                <tbody>
                                    @foreach($affiliations as $data)
                                    <tr>
                                        <td>{{$data->statutoryName}}</td>
                                        <td>{{$data->designationName}}</td>
                                        <td>{{$data->affiliation}}</td>
                                        <td>{{$data->statutoryBody}}</td>
                                    </tr>
                                    @endforeach
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>