<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<p>Dear {{@$content['name']}}</p>
<p>Your Account has been activated by the administrator of NBEAC:</p>
<p>Name: {{@$content['name']}}</p>
<p>Designation: {{@$content->designation->name}}</p>
<p>email: {{@$content['email']}}</p>
<p>contact No: {{@$content['contact_no']}}</p>
<p>Institute: {{@$content->business_school->name}}</p>
<p>Department: {{@$content->department->name}}</p>
<p>Account Type: {{@$content['user_type']}}</p>
{{--<p>address: {{$content['address']}}</p>--}}


<a href="www.nbeac.org.pk">Login to Online Accreditation Application.</a>
<p>With Kind Regards,</p>
<p>NBEAC</p>
<p>National Business Education Accreditation Council,</p>
<p></p>201,2nd Floor, HRD Division,Higher Education Commission, H-8 Islamabad, Pakistan</body>
<p>Phone (Off) 92 51 9080 0206-07</p>
<p>Fax: +92 51 9080 0208</p>
<p>Web: <a href="www.nbeac.org.pk"> www.nbeac.org.pk</a></p>

</body>
</html>
