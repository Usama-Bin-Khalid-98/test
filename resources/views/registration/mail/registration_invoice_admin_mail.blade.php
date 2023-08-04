<!doctype html>
<html>
@include("registration.mail.includes.mail_header")

<body class="">
<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
    <tr>
        <td>&nbsp;</td>
        <td class="container">
            <div class="content">

                <!-- START CENTERED WHITE CONTAINER -->
                <table role="presentation" class="main">

                    <!-- START MAIN CONTENT AREA -->
                    <tr>
                        <td class="wrapper">
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p></p>
                                        <p>Dear Admin NBEAC,</p>
                                        <p>I hope this email finds you well. I am writing to inform you that an invoice has been generated for Registration. The details of the invoice are as follows</p>
                                        <br>
                                        <p>Invoice Number : {{@$data['slip']->invoice_no}}</p>
                                        <p>Invoice Date : {{@$data['slip']->transaction_date}}</p>
                                        <p>Total Amount : {{@$data['slip']->amount}} </p>
                                        <br>
                                        <p>I kindly request your approval for this invoice so that we can proceed further.</p>
                                        <br>
                                        <p>Thank you</p>
                                        <p>{{@$data['school']->user->name}}</p>
                                        <p>{{@$data['school']->name}}</p>
                                        </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->

                @include("registration.mail.includes.mail_footer"))

            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>

</html>