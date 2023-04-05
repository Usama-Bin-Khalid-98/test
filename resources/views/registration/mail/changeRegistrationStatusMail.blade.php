<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<p>
<p style="font-weight: bold">Dear {{@$data['user']}},</p>

<p>Hope you are doing well,</p>
<p>Thank you for submitting the registration application of {{@$data['department']}} {{@$data['school']->campus->business_school->name}}, {{@$data['campus']}}. The desk review of registration application is under process. You can check the status of your application on the registration application page. <a href="{{url('strategic/invoices')}}">(Link)</a></p>
<p>Thank You.</p>

<p>Regards,</p>
@php
$nbeac = \App\Models\Config\NbeacBasicInfo::all()->first();
@endphp
<p style="color: #1d68a7">{{@$nbeac->director}} || Mr. Irfan Khan</p>
<p style="color: #1d68a7">Assistant Manager Accreditation</p>
<p style="color: #1d68a7">Phone-I (Off) 92 51 9080 0214</p>
<p style="color: #1d68a7">Phone-II (Cell): +92 333 5126229</p>
<p style="color: #1d68a7">Web: www.nbeac.org.pk</p>
<small>*Please do not reply to this email. This is computer generated email</small>
<small>*For any query related to the program, please email us at mirkhan@hec.gov.pk</small>
</body>
</html>
