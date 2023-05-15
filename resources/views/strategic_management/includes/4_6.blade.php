
<div class="box-body table-responsive">
                            <table   class="table table-bordered table-striped " style="width: 100%">
                                <caption style="text-align: center;color: red">Table 4.6. Gender mix</caption>
                                <thead>
                                    <th>Gender</th>
                                    <th>Permanent/Regular</th>
                                    <th>Adjunct</th>
                                    <th>Visiting</th>


                                </thead>
                                <tbody>
                                   <?php
                                    $male_faculty_percentage = [];
                                    foreach($facultyGenders as $fac){
                                        $male_faculty_percentage[$fac->facultyTypeName] = $fac->male;
                                    }
                                   ?>
                                    <tr>
                                        <td>Male</td>
                                        <td>{{@$male_faculty_percentage['Permanent']}}</td>
                                        <td>{{@$male_faculty_percentage['Adjunct']}}</td>
                                        <td>{{@$male_faculty_percentage['Visiting']}}</td>



                                    </tr>

                                    <tr>
                                        <td>Female</td>
                                        <td>@if(@$male_faculty_percentage['Permanent']){{100 - @$male_faculty_percentage['Permanent']}}@endif</td>
                                        <td>@if(@$male_faculty_percentage['Adjunct']){{100 - @$male_faculty_percentage['Adjunct']}}@endif</td>
                                        <td>@if(@$male_faculty_percentage['Visiting']){{100 - @$male_faculty_percentage['Visiting']}}@endif</td>



                                    </tr>


                                </tbody>
                                <tfoot></tfoot>



                            </table>
                        </div>
