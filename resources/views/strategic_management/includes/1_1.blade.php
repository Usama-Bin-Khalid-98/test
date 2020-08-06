<div class="box-body table-responsive">
                            <table id=""  class="table table-bordered table-striped">
                                <caption style="text-align: center;">Table 1.1. Basic information of business school</caption>
                                <thead>
                                    <tr>
                                        <th>a)  Name of the university/parent institution</th>
                                        <th>{{$bussinessSchool[0]->name}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                <tr>
                                    <td>b)  Year of  establishment (university/parent institution)</td>
                                    <td>{{$bussinessSchool[0]->year_estb}}</td>
                                </tr>
                                <tr>
                                    <td>c)  Chief administrative officer</td>
                                    <td>{{$bussinessSchool[0]->designationName}}</td>
                                </tr>
                                <tr>
                                    <td>d)  Name of Chief Administrative Officer</td>
                                    <td>{{$bussinessSchool[0]->contact_person}}</td>
                                </tr>
                                <tr>
                                    <td>e)  Name of the business school and campus (if relevant)</td>
                                    <td>{{$bussinessSchool[0]->year_estb}}</td>
                                </tr>
                                <tr>
                                    <td>f)  Year of establishment of the business school</td>
                                    <td>{{$bussinessSchool[0]->year_estb}}</td>
                                </tr>
                                <tr>
                                    <td>g)  Address of the business school</td>
                                    <td>{{$bussinessSchool[0]->address}}</td>
                                </tr>
                                <tr>
                                    <td>h)  Website URL</td>
                                    <td>{{$bussinessSchool[0]->web_url}}</td>
                                </tr>
                                <tr>
                                    <td>i)  Date on which Charter granted</td>
                                    <td>{{$bussinessSchool[0]->date_charter_granted}}</td>
                                </tr>
                                <tr>
                                    <td>j)  Reference number of Charter</td>
                                    <td>{{$bussinessSchool[0]->charter_number}}</td>
                                </tr>
                                <tr>
                                    <td>k)  Charter type</td>
                                    <td>{{$bussinessSchool[0]->charterName}}</td>
                                </tr>
                                <tr>
                                    <td>l)  Institution type</td>
                                    <td>{{$bussinessSchool[0]->typeName}}</td>
                                </tr>
                                <tr>
                                    <td>m)  Sector</td>
                                    <td>{{$bussinessSchool[0]->sector}}</td>
                                </tr>
                                <tr>
                                    <td>n)  Profit/Non-profit status</td>
                                    <td>{{$bussinessSchool[0]->profit_status}}</td>
                                </tr>
                                <tr>
                                    <td>o)  Hierarchical context</td>
                                    <td>{{$bussinessSchool[0]->hierarchical_context}}</td>
                                </tr>
                                <tr>
                                    <td>p)  Number of other campuses (if any)</td>
                                    <td>{{count($campuses)}}</td>
                                </tr>
                                <tr>
                                    <td>q)  Location of other campuses (if any)</td>
                                    <td>@foreach ($campuses as $value)
                                        {{$value->location.", "}}
                                        @endforeach
                                    </td>
                                </tr>
                              
                                </tbody>
                                <tfoot></tfoot>
                              
                              

                            </table>
                        </div>