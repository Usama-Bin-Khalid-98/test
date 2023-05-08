@component('mail::message')
{{-- Intro Lines --}}
@foreach ($introLines as $line)
<p style="color:black;">{{ $line }}</p>

@endforeach 
{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

If you did not create an account, no further action is required.

Regards,<br>
Mr. Irfan Khan<br>
Assistant Manager Accreditation,<br>
<!-- <p>201,2nd Floor, HRD Division,Higher Education Commission, H-8 Islamabad, Pakistan</p> -->
Phone-I (Off) 92 51 9080 0214<br>
Phone-II (Cell): +92 333 5126229<br>
<!-- <p>Fax: +92 51 9080 0208</p> -->
Web: <a href="https://app.nbeac.org.pk"> www.nbeac.org.pk</a></p>
<small>*Please do not reply to this email. This is computer generated email</small>
<small>*For any query related to the program, please email us at mirkhan@hec.gov.pk</small>
{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "If you’re having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
    'into your web browser:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
