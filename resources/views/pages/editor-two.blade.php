@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mt-5">
                <div class="card-header">  <h3>Form Two</h3></div>
                <div class="card-body">
                    <form method="get" action="{{ route('export-pdf') }}">
                        @csrf
                        <textarea name="content" id="content">

{{--    <div class="mceNonEditable"> Non Editable Contents</div>--}}

        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; tab-stops: 0in;"><strong><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi;">No. C &amp; W/Cons/LOI/....</span></strong><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi;">/23/A/B-......<span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="color: #00b050;">(Current date</span>................... 2023</span></strong></p>
        <p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 5.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;"><span style="text-decoration: none;">&nbsp;</span></span></u></strong></p>
        <p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 1.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;"><span style="text-decoration: none;">&nbsp;</span></span></u></strong></p>
        <p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">Letter of Introduction</span></u></strong></p>
        <p class="MsoNormal" style="text-align: center;" align="center"><strong style="mso-bidi-font-weight: normal;"><u><span style="font-size: 8.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;"><span style="text-decoration: none;">&nbsp;</span></span></u></strong></p>
        <p class="MsoNormal" style="text-align: justify; text-indent: .5in;"><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">This is to inform that the following official of<span style="color: #00b050;">(1*the organization name:</span><span style="color: red;"> Ministry of Information)</span><strong style="mso-bidi-font-weight: normal;"> </strong>Government of the People&rsquo;s Republic of Bangladesh and his/her family members </span><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">would like to visit </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">the <span style="color: #00b050;">(4*Name of the Embassy/High Commission:</span><span style="color: red;"> the High Commission of Canada)</span> in Dhaka </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: #222222;">from </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: #00b050;">(8*date .....</span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: red;"> </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: black; mso-themecolor: text1;">to</span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: red;"> </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: #00b050;">date........)</span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-fareast-font-family:  mso-bidi-theme-font: minor-bidi; color: #222222;"> in</span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi; mso-bidi-font-weight: bold;"> <span style="color: red;">(</span><span style="color: #00b050;">country name</span><span style="color: red;">: Canada):</span></span><span style="font-family: serif; mso-bidi-theme-font: minor-bidi;"> </span><span style="font-size: 13.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">to <span style="mso-bidi-font-weight: bold;">attend <span style="color: #00b050;">the (6&ldquo;name of the event:7 * date to date</span><span style="color: red;">...............................&rdquo;)</span></span></span><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">: </span></p>
        <p class="MsoNormal" style="text-align: justify; text-indent: .5in;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">2*</span></p>
        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; text-indent: .5in;"><span style="font-size: 5.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">&nbsp;</span></p>
        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; text-indent: .5in;"><span style="font-size: 3.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">&nbsp;</span></p>

        <table class="MsoTableGrid" style="margin-left: 27.9pt; border-collapse: collapse; border: none; mso-border-alt: solid black .5pt; mso-yfti-tbllook: 1184; mso-padding-alt: 0in 5.4pt 0in 5.4pt;" border="1" cellspacing="0" cellpadding="0">
            <tbody>
            <tr style="mso-yfti-irow: 0; mso-yfti-firstrow: yes;">
            <td style="width: .75in; border: solid black 1.0pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">
            <p class="MsoNormal" style="text-align: justify;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Sl. No. </span></strong></p>
            </td>
            <td style="width: 265.5pt; border: solid black 1.0pt; border-left: none; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            <p class="MsoNormal" style="text-align: justify;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Name &amp; Relationship/Other Designation</span></strong></p>
            </td>
            <td style="width: 94.5pt; border: solid black 1.0pt; border-left: none; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Passport No.</span></strong></p>
            </td>
            </tr>
            <tr style="mso-yfti-irow: 1;">
            <td style="width: .75in; border: solid black 1.0pt; border-top: none; mso-border-top-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">
            <p class="MsoNormal" style="text-align: center;" align="center"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">01.</span></p>
            </td>
            <td style="width: 265.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Mrs. ........., Spouse</span></p>
            </td>
            <td style="width: 94.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span></p>
            </td>
            </tr>
            <tr style="mso-yfti-irow: 2;">
            <td style="width: .75in; border: solid black 1.0pt; border-top: none; mso-border-top-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">
            <p class="MsoNormal" style="text-align: center;" align="center"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">02.</span></p>
            </td>
            <td style="width: 265.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Ms. ..........., Daughter</span></p>
            </td>
            <td style="width: 94.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span></p>
            </td>
            </tr>
            <tr style="mso-yfti-irow: 3;">
            <td style="width: .75in; border: solid black 1.0pt; border-top: none; mso-border-top-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">
            <p class="MsoNormal" style="text-align: center;" align="center"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">03.</span></p>
            </td>
            <td style="width: 265.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Ms. ..........., Daughter</span></p>
            </td>
            <td style="width: 94.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span></p>
            </td>
            </tr>
            <tr style="mso-yfti-irow: 4; mso-yfti-lastrow: yes;">
            <td style="width: .75in; border: solid black 1.0pt; border-top: none; mso-border-top-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">
            <p class="MsoNormal" style="text-align: center;" align="center"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">04.</span></p>
            </td>
            <td style="width: 265.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">Mr. ..........., Son</span></p>
            </td>
            <td style="width: 94.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span></p>
            </td>
            </tr>
            </tbody>
        </table>
        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; text-indent: .5in;"><span style="font-size: 7.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">&nbsp;</span></p>
        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; text-indent: .5in;"><span style="font-size: 1.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">&nbsp;</span></p>
        <p class="MsoNormal" style="margin-bottom: 0in; text-align: justify; text-indent: .5in;"><span style="font-size: 1.0pt; mso-bidi-font-size: 11.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;">&nbsp;</span></p>
        <p class="MsoNoSpacing" style="text-align: justify; text-indent: .5in; line-height: 115%;"><span style="font-size: 13.0pt; line-height: 115%; font-family: serif;">The esteemed <span style="color: #00b050;">(4*Name of the embassy/High Commission</span><span style="color: red;">: High Commission of Canada) </span><span style="mso-spacerun: yes;">&nbsp;</span>in Dhaka is requested to kindly facilitate their visa issuance process.</span></p>
        <p class="MsoNoSpacing" style="margin-left: 2.5in; text-align: justify; text-indent: .5in; line-height: 115%;"><span style="font-size: 13.0pt; line-height: 115%; font-family: serif;"><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span></p>
        <p class="MsoNoSpacing" style="text-align: justify; text-indent: .5in; line-height: 115%;"><span style="font-size: 13.0pt; line-height: 115%; font-family: serif;"><span style="mso-spacerun: yes;">&nbsp;</span></span></p>
        <p class="MsoNoSpacing" style="margin-left: 3.5in; text-indent: .5in; line-height: 115%;"><span style="font-size: 13.0pt; line-height: 115%; font-family: serif;"><span style="mso-spacerun: yes;">&nbsp;&nbsp; </span><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>(G. M. Iftekhar)</span></p>
        <p class="MsoNoSpacing" style="margin-left: 2.5in; text-align: center; text-indent: .5in; line-height: 115%;" align="center"><span style="font-size: 1.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span></p>
        <p class="MsoNormal" style="text-align: center; margin: 0in 0in 0in 3.0in;" align="center"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif; mso-bidi-theme-font: minor-bidi;"><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Assistant Secretary (Consular)</span></p>
        <p class="MsoNoSpacing" style="text-align: center;" align="center"><span style="font-size: 13.0pt; font-family: serif;"><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dhaka</span></p>
        <p class="MsoNoSpacing"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; font-family: serif; color: #00b050;">(4*Embassy name</span></strong><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; font-family: serif; color: red;">: High Commission of Canada)</span></strong></p>
        <p class="MsoNoSpacing"><strong style="mso-bidi-font-weight: normal;"><span style="font-size: 13.0pt; font-family: serif;">Dhaka</span></strong></p>
        <p class="MsoNormal">&nbsp;</p>
    </textarea>
                        <button type="submit" class="btn btn-success btn-sm float-end">Download PDF</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
