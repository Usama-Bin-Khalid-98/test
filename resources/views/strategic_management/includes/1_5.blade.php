
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 1.5. Affiliations of any external (academic and corporate), national or international members</caption>
                                <thead>
                                    <th>No.</th>
                                    <th>Name of member</th>
                                    <th>Designation</th>
                                    <th>Affiliation</th>
                                    <th>Name of statutory body</th>
                                </thead>
                                <tbody>

                                    @foreach($affiliations as $data)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$data->name}}</td>
                                        <td>{{@$data->designationName}}</td>
                                        <td>{{$data->affiliation}}</td>
                                        <td>{{$data->statutoryBody}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
