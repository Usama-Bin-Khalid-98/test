<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<p>
<p style="font-weight: bold">Dear {{@$data['user']}},</p>
<p style="font-weight: bold">{{@$data['designation']}},</p>
<p style="font-weight: bold">{{@$data['school']}},{{@$data['campus']}}</p>

<p>Hope you are doing well,</p>

<p>This email is with reference to registration fee received from {{@$data['school']}}, Campus {{@$data['campus']}} it is acknowledge that we received the registration fee <span style="font-weight: bold"> Cheque No: {{@$data['cheque_no']}}, Amount Rs: 50,000/- dated {{@$data['transaction_date']}}. </span> </p>
{{--<p>address: {{$content['address']}}</p>--}}

<p style="color: #0b93d5;">The registration application is under desk review process.  You can check the status of your application on the following link: </p>

<p>Thank You.</p>

<p>Best Regards,</p>
@php
$nbeac = \App\Models\Config\NbeacBasicInfo::all()->first();
@endphp
<p style="color: #1d68a7">{{@$nbeac->director}} || Director<br>
    {{@$nbeac->name}} ({{@$nbeac->short_name}}),</p>
<p style="color: grey">{{@$nbeac->address}}<br>
Phone (Off): {{@$nbeac->phone1}} || Cell: {{@$nbeac->phone2}}</p>
Fax: {{@$nbeac->fax}}</p>

</body>
</html>
