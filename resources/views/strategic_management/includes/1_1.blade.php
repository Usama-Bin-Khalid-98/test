<div class="box-body table-responsive ">
                            <table id=""  class="table table-bordered table-striped">
                                <caption style="text-align: center;color: red">Table 1.1. Basic information of business school</caption>
                                <thead>
                                    
                                    <tr>
                                        <th>a)  Name of the university/parent institution</th>
                                        <th><?php if(isset($bussinessSchool[0]->name))
                                    print_r($bussinessSchool[0]->name);
                                    ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                               
                                <tr class="left">
                                    <td>b)  Year of  establishment (university/parent institution)</td>
                                    <td><?php if(isset($bussinessSchool[0]->year_estb))
                                    print_r($bussinessSchool[0]->year_estb);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>c)  Chief administrative officer</td>
                                    <td><?php if(isset($bussinessSchool[0]->designationName))
                                    print_r($bussinessSchool[0]->designationName);
                                    ?></td>
                                </tr>
                                <tr class="left">
                                    <td>d)  Name of Chief Administrative Officer</td>
                                    <td><?php if(isset($bussinessSchool[0]->contact_person))
                                    print_r($bussinessSchool[0]->contact_person);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>e)  Name of the business school and campus (if relevant)</td>
                                    <td><?php if(isset($bussinessSchool[0]->name))
                                    print_r($bussinessSchool[0]->name);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>f)  Year of establishment of the business school</td>
                                    <td><?php if(isset($bussinessSchool[0]->year_estb))
                                    print_r($bussinessSchool[0]->year_estb);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>g)  Address of the business school</td>
                                    <td><?php if(isset($bussinessSchool[0]->address))
                                    print_r($bussinessSchool[0]->address);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>h)  Website URL</td>
                                    <td><?php if(isset($bussinessSchool[0]->web_url))
                                    print_r($bussinessSchool[0]->web_url);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>i)  Date on which Charter granted</td>
                                    <td><?php if(isset($bussinessSchool[0]->date_charter_granted))
                                    print_r($bussinessSchool[0]->date_charter_granted);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>j)  Reference number of Charter</td>
                                    <td><?php if(isset($bussinessSchool[0]->charter_number))
                                    print_r($bussinessSchool[0]->charter_number);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>k)  Charter type</td>
                                    <td><?php if(isset($bussinessSchool[0]->charterName))
                                    print_r($bussinessSchool[0]->charterName);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>l)  Institution type</td>
                                    <td><?php if(isset($bussinessSchool[0]->typeName))
                                    print_r($bussinessSchool[0]->typeName);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>m)  Sector</td>
                                    <td><?php if(isset($bussinessSchool[0]->sector))
                                    print_r($bussinessSchool[0]->sector);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>n)  Profit/Non-profit status</td>
                                    <td><?php if(isset($bussinessSchool[0]->profit_status))
                                    print_r($bussinessSchool[0]->profit_status);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>o)  Hierarchical context</td>
                                    <td><?php if(isset($bussinessSchool[0]->hierarchical_context))
                                    print_r($bussinessSchool[0]->hierarchical_context);
                                    ?> </td>
                                </tr>
                                <tr class="left">
                                    <td>p)  Number of other campuses (if any)</td>
                                    <td><?php 
                                    ?>{{count($campuses)}}</td>
                                </tr>
                                <tr class="left">
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