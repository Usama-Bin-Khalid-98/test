<!doctype html>
<html>
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{@$title}}</title>
    <style>
        /* -------------------------------------
    GLOBAL RESETS
------------------------------------- */

        /*All the styling goes here*/

        img {
            border: none;
            -ms-interpolation-mode: bicubic;
            max-width: 100%;
        }

        body {
            background-color: #f6f6f6;
            font-family: sans-serif;
            -webkit-font-smoothing: antialiased;
            font-size: 14px;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table {
            border-collapse: separate;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
            width: 100%; }
        table td {
            font-family: sans-serif;
            font-size: 14px;
            vertical-align: top;
        }

        /* -------------------------------------
            BODY & CONTAINER
        ------------------------------------- */

        .body {
            background-color: #f6f6f6;
            width: 100%;
        }

        /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
        .container {
            display: block;
            margin: 0 auto !important;
            /* makes it centered */
            max-width: 580px;
            padding: 10px;
            width: 580px;
        }

        /* This should also be a block element, so that it will fill 100% of the .container */
        .content {
            box-sizing: border-box;
            display: block;
            margin: 0 auto;
            max-width: 580px;
            padding: 10px;
        }

        /* -------------------------------------
            HEADER, FOOTER, MAIN
        ------------------------------------- */
        .main {
            background: #ffffff;
            border-radius: 3px;
            width: 100%;
        }

        .wrapper {
            box-sizing: border-box;
            padding: 20px;
        }

        .content-block {
            padding-bottom: 10px;
            padding-top: 10px;
        }

        .footer {
            clear: both;
            margin-top: 10px;
            text-align: center;
            width: 100%;
        }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
            color: #999999;
            font-size: 12px;
            text-align: center;
        }

        /* -------------------------------------
            TYPOGRAPHY
        ------------------------------------- */
        h1,
        h2,
        h3,
        h4 {
            color: #000000;
            font-family: sans-serif;
            font-weight: 400;
            line-height: 1.4;
            margin: 0;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 35px;
            font-weight: 300;
            text-align: center;
            text-transform: capitalize;
        }

        p,
        ul,
        ol {
            font-family: sans-serif;
            font-size: 14px;
            font-weight: normal;
            margin: 0;
            margin-bottom: 15px;
        }
        p li,
        ul li,
        ol li {
            list-style-position: inside;
            margin-left: 5px;
        }

        a {
            color: #3498db;
            text-decoration: underline;
        }

        /* -------------------------------------
            BUTTONS
        ------------------------------------- */
        .btn {
            box-sizing: border-box;
            width: 100%; }
        .btn > tbody > tr > td {
            padding-bottom: 15px; }
        .btn table {
            width: auto;
        }
        .btn table td {
            background-color: #ffffff;
            border-radius: 5px;
            text-align: center;
        }
        .btn a {
            background-color: #ffffff;
            border: solid 1px #3498db;
            border-radius: 5px;
            box-sizing: border-box;
            color: #3498db;
            cursor: pointer;
            display: inline-block;
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            padding: 12px 25px;
            text-decoration: none;
            text-transform: capitalize;
        }

        .btn-primary table td {
            background-color: #3498db;
        }

        .btn-primary a {
            background-color: #3498db;
            border-color: #3498db;
            color: #ffffff;
        }

        /* -------------------------------------
            OTHER STYLES THAT MIGHT BE USEFUL
        ------------------------------------- */
        .last {
            margin-bottom: 0;
        }

        .first {
            margin-top: 0;
        }

        .align-center {
            text-align: center;
        }

        .align-right {
            text-align: right;
        }

        .align-left {
            text-align: left;
        }

        .clear {
            clear: both;
        }

        .mt0 {
            margin-top: 0;
        }

        .mb0 {
            margin-bottom: 0;
        }

        .preheader {
            color: transparent;
            display: none;
            height: 0;
            max-height: 0;
            max-width: 0;
            opacity: 0;
            overflow: hidden;
            mso-hide: all;
            visibility: hidden;
            width: 0;
        }

        .powered-by a {
            text-decoration: none;
        }

        hr {
            border: 0;
            border-bottom: 1px solid #f6f6f6;
            margin: 20px 0;
        }

        /* -------------------------------------
            RESPONSIVE AND MOBILE FRIENDLY STYLES
        ------------------------------------- */
        @media only screen and (max-width: 620px) {
            table[class=body] h1 {
                font-size: 28px !important;
                margin-bottom: 10px !important;
            }
            table[class=body] p,
            table[class=body] ul,
            table[class=body] ol,
            table[class=body] td,
            table[class=body] span,
            table[class=body] a {
                font-size: 16px !important;
            }
            table[class=body] .wrapper,
            table[class=body] .article {
                padding: 10px !important;
            }
            table[class=body] .content {
                padding: 0 !important;
            }
            table[class=body] .container {
                padding: 0 !important;
                width: 100% !important;
            }
            table[class=body] .main {
                border-left-width: 0 !important;
                border-radius: 0 !important;
                border-right-width: 0 !important;
            }
            table[class=body] .btn table {
                width: 100% !important;
            }
            table[class=body] .btn a {
                width: 100% !important;
            }
            table[class=body] .img-responsive {
                height: auto !important;
                max-width: 100% !important;
                width: auto !important;
            }
        }

        /* -------------------------------------
            PRESERVE THESE STYLES IN THE HEAD
        ------------------------------------- */
        @media all {
            .ExternalClass {
                width: 100%;
            }
            .ExternalClass,
            .ExternalClass p,
            .ExternalClass span,
            .ExternalClass font,
            .ExternalClass td,
            .ExternalClass div {
                line-height: 100%;
            }
            .apple-link a {
                color: inherit !important;
                font-family: inherit !important;
                font-size: inherit !important;
                font-weight: inherit !important;
                line-height: inherit !important;
                text-decoration: none !important;
            }
            #MessageViewBody a {
                color: inherit;
                text-decoration: none;
                font-size: inherit;
                font-family: inherit;
                font-weight: inherit;
                line-height: inherit;
            }
            .btn-primary table td:hover {
                background-color: #34495e !important;
            }
            .btn-primary a:hover {
                background-color: #34495e !important;
                border-color: #34495e !important;
            }
        }


    </style>
</head>
<body class="">
{{--<span class="preheader">This is preheader text. Some clients will show this text as a preview.</span>--}}
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
                                        <p>Dear Ms. Mehrunnisa,<br>
                                                Deputy Registrar Accreditation & Focal person,<br>
                                                Lahore School of Economics
                                        </p>
                                        <p></p>
                                        <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                                            <tbody>
                                            <tr>
                                                <td align="left">
                                                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                        <tr>
                                                            {{--                                                            <td> <a href="http://htmlemail.io" target="_blank">Call To Action</a> </td>--}}
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                        <p>The  03 days peer review visit of  Lahore School of Economics will be held from 24th Feb 2020 to  26th Feb 2020 for BBA, MBA and BSc(Hons.) programs.  The name of approved Peer Review Team (PRT) members are: </p>

                                        <p><b>1.    Dr. Asfia Obaid, HoD, NUST Business School<br>
                                            2.    Dr. Niaz Bhutto, HoD, IBA Sukkur<br>
                                            3.    Mr. Adil Amin Kazi, Assistant Professor, FAST_NU Islamabad<br>
                                            4.    Dr. Amber Gul, Director QEC, IBA Karachi<br>
                                            5.    Mr. Usman Tahir, Director, Texlynx Development and Management Associates<br>
                                            6.    Ms. Sania Tufail, Senior Program Manager Accreditation, NBEAC.</b>
                                        </p>

                                        <p>1.         Kindly inform if there are any other campuses (i.e. virtual/satellite  campus)of the University within the city where the same programs are offered for which accreditation visit is going to be held. We have to adjust the visit of any other campus in the attached schedule.<br>
                                            2.         It is to inform you that boarding and lodging will be arranged by the Business School. It is the responsibility of the Business School to make necessary logistic arrangements from the airport/station to the site for the visit, including local travel. The Business School also takes measures to arrange accommodation of the panel members in the hotel or the Business School’s hostel or guest house near to the site for efficient time management. NBEAC advises the Business School to keep the lunches short and simple, involving minimum disturbance. It is requested to avoid any type of gifts except University souvenirs. For further details on Peer Review Visit, you may read Section V & VI of the NBEAC Accreditation Process Manual.<br>
                                            3.         Please arrange a preliminary meeting for Peer Review Team(only) over the dinner one day before the visit, in the same hotel or guest house where they are lodging.<br>
                                            4.         It is also required that school should fill a schedule of meetings (Sample attached) in a weeks’ time.  Attached herewith the sample of how requirements of peer review visit can be fulfilled. The format can be changed to take into account the specific circumstances of school. The class visit timing is adjustable as per the timetable. The proposed schedule of school should be reviewed by NBEAC Secretariat and Chairperson-Peer Review Team. In the Peer Review Visit schedule, it is requested to provide the name of all participants attending the sessions during the peer review visit.<br>
                                            5.         Informal meeting with Alumni & Employers  would be arranged on Day 01 after 5.00 pm. Alumni meeting is an informal discussion session with alumni and employers, there should not be any formal speeches or so.<br>
                                            6.         Airfare and Honorarium of peer review members will be sponsored by NBEAC.<br>
                                            7.         Kindly ensure the participation of higher management (incl. dean, director or vice chancellor) in the opening session ( 09.30am to 10.30 am) on day 1 and closing session ( any time till 01 pm on day 3).<br>
                                            8.         Kindly ensure that there should not be any recording/camera device in the room where the three days proceedings held.
                                        </p>

                                        <p style="text-decoration: underline;"><em>For travel/accommodation  plan, Mr. Usman (03362829304)  from NBEAC will coordinate with you a week before the accreditation visit.</em></p>
                                        <br><br>
                                        <p>Thank You.</p>

                                        <p><span style="color: #1d68a7">With Regards,<br>
                                            -----------------------------------------------------------------------------------------------------------<br>
                                            Sania Tufail<br>
                                            Senior Program Manager-Accreditation,<br>
                                                National Business Education Accreditation Council,</span><br>
                                            <span style="color: grey">201,2nd Floor, HRD Division,Higher Education Commission, H-8 Islamabad, Pakistan<br>
                                            Phone (Off) 92 51 9080 0206<br>
                                            Fax: +92 51 9080 0208</span>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- END MAIN CONTENT AREA -->
                </table>
                <!-- END CENTERED WHITE CONTAINER -->

                <!-- START FOOTER -->
                <div class="footer">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-block">
                                <span class="apple-link">National Business Education Accreditation Council (NBEAC)</span>
                                <br> Don't like these emails? <a href="http://nbeac.pk">Unsubscribe</a>.
                            </td>
                        </tr>
                        <tr>
                            <td class="content-block powered-by">
                                Powered by <a href="http://htmlemail.io">NBEAC</a>.
                            </td>
                        </tr>
                    </table>
                </div>
                <!-- END FOOTER -->

            </div>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>
