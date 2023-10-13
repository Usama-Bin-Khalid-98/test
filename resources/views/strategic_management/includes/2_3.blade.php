
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped ">
                                <caption style="text-align: center;color: red">Table 2.3. Curriculum review</caption>
                                <thead>
                                    <th>Curriculum review meeting</th>
                                    <th>Date</th>
                                    <th>Composition</th>
                                    <th>Reviewer names</th>
                                    <th>Designation & affiliation</th>
                                </thead>
                                <tbody>
                                    @foreach($curriculumReviews as $data)
                                    <tr>
                                        <td>{{"Meeting "}}{{$loop->index+1}}</td>
                                        <td>{{$data->date}}</td>
                                        <td>{{$data->composition}}</td>
{{--                                        <td>@if($portfolio->curriculum_reviewer)--}}
{{--                                                @foreach(@$portfolio->curriculum_reviewer as $reviewers) {{$reviewers->user->name}},--}}
{{--                                                @endforeach @endif--}}
{{--                                        </td>--}}
                                        <td>{{$data->reviewer_names}}</td>
                                        <td>{{$data->designation}}{{": "}}{{$data->affiliation}}</td>
                                    </tr>
                                     @endforeach


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
