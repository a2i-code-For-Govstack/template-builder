@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card mt-5">
                <div class="card-header">  <h3>Form One</h3></div>
                <div class="card-body">
                    <!-- Insert the blade containing the TinyMCE placeholder HTML element -->
                    <form method="get" action="{{ route('export-pdf') }}">
                        @csrf
                        <textarea name="content" id="content">
                            <p class="MsoNormal">&nbsp;</p>

                            <table style="border-collapse: collapse; width: 100%; border-width: 0px;  border-style: none;" ><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
                                <tbody>
                                <tr>
                                <td style="border-width: 0px; "><strong>No. C&amp;W/Cons/NV/..... /23/A/B-.......&nbsp;</strong></td>
                                <td style="border-width: 0px; text-align: right;"><strong>Date: {{$date}}</strong></td>
                                </tr>
                                </tbody>
                            </table>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh presents its compliments to (*4.Name of the Embassy/High Commission: the High Commission of Canada) in Dhaka and has the honour to inform that the following officials/delegation/persons of (1. the organization name: Ministry of Information) Government of the People&rsquo;s Republic of Bangladesh would like to visit 3. Country: Canada from (8. date........) to (date...........) to attend the (6. &ldquo;name of the event...............................&rdquo;) to be held from (7. date ..... to date........) in 9. Event location , (3. country name: Canada):</p>
                            <p class="MsoNormal">2*</p>
                            <p class="MsoNormal">Sl. No.<span style="mso-tab-count: 1;">&nbsp;&nbsp; </span>Name &amp; Designation <span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp; </span>Passport No.</p>
                            <p class="MsoNormal">01.<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>( Address as per gender) Mr./Ms................<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
                            <p class="MsoNormal">02.<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>( Address as per gender) Mr./Ms................<span style="mso-tab-count: 1;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry would appreciate if the esteemed Embassy/High Commission could kindly endorse necessary visa in their favor.</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh avails itself of this opportunity to renew to the (4*Embassy name High Commission of Canada) in Dhaka the assurances of its highest consideration.</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal">&nbsp;</p>
                            <p class="MsoNormal"><span style="mso-spacerun: yes;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>Dhaka, (10*current date)</p>
                            <p class="MsoNormal">(4*Embassy name: High Commission of Canada)</p>
                            <p class="MsoNormal">Dhaka</p>
                        </textarea>
                        <button type="submit" class="btn btn-success btn-sm float-end">Download PDF</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
