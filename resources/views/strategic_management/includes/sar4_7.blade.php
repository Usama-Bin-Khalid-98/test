
<div class="box-body table-responsive">
    <table   class="table table-bordered table-striped ">
        <caption style="text-align: center;color: red">Table 4.7. Number of Faculty Degree </caption>
        <thead>
            <th>No</th>
            <th>Date</th>
            <th>Venue</th>
            <th>Title</th>
            <th>Name of faculty trainer</th>
            <th>No. of participants</th>
            
            
        </thead>
        <tbody>
            @foreach($facultyWorkshops as $facultyWorkshop)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$facultyWorkshop->date}}</td>
                <td>{{$facultyWorkshop->venue}}</td>
                <td>{{$facultyWorkshop->title}}</td>
                <td>{{$facultyWorkshop->faculty_trainer_name}}</td>
                <td>{{$facultyWorkshop->participants}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
        
        

    </table>
</div>