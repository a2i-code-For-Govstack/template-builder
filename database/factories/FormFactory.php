<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Form>
 */
class FormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'sid' =>  random_int(1, 9999),
            'template_type' => 1,
            'font_type' => 1,
            'paper_size' => 1,
            'page_type' => 1,
            'category' => 1,
            'content' => '<p class="MsoNormal">&nbsp;</p>
            <table style="border-collapse: collapse; width: 100%; border-width: 0px; border-style: none;"><colgroup><col style="width: 50%;"><col style="width: 50%;"></colgroup>
            <tbody>
            <tr>
            <td style="border-width: 0px;"><strong>No. C&amp;W/Cons/NV/..... /23/A/B-.......&nbsp;</strong></td>
            <td style="border-width: 0px; text-align: right;"><strong>Date: {{issuance_date}}</strong></td>
            </tr>
            </tbody>
            </table>
            <p class="MsoNormal">&nbsp;</p>
            <p class="MsoNormal" style="text-align: justify;">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh presents its compliments to {{applied_embassy_highcommission}} in {{country_to_visit}} and has the honour to inform that the following officials/delegation/persons of {{applied_embassy_highcommission}} Government of the People&rsquo;s Republic of Bangladesh would like to visit {{country_to_visit}} from {{from_date_of_the_Travel_to_the_country}} to {{to_date_of_the_Travel_to_the_country}} to attend the {{name_of_the_event}} to be held from {{from_date_of_the_event}} to {{to_date_of_the_event}} in {{events_location_name_of_the_city}} {{country_to_visit}}</p>
            <table style="border-collapse: collapse; width: 100%; height: 67.1718px; border-width: 1px; border-color: #000000;" border="1"><colgroup><col style="width: 33.2589%;"><col style="width: 33.2589%;"><col style="width: 33.2589%;"></colgroup>
            <tbody>
            <tr style="height: 22.3906px;">
            <td style="border-width: 1px; height: 22.3906px; border-color: rgb(0, 0, 0);"><strong>Sl. No.</strong></td>
            <td style="border-width: 1px; height: 22.3906px; border-color: rgb(0, 0, 0);"><strong>Name &amp; Designation</strong></td>
            <td style="border-width: 1px; height: 22.3906px; border-color: rgb(0, 0, 0);"><strong><span style="mso-tab-count: 1;"> &nbsp;</span>Passport No.</strong></td>
            </tr>
            <tr style="mso-yfti-irow: 1;">
            <td style="width: .75in; border: solid black 1.0pt; border-top: none; mso-border-top-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="72">{{sl_no_01}}</td>
            <td style="width: 265.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="354">
            {{name_of_the_applicant_01}}</td>
            <td style="width: 94.5pt; border-top: none; border-left: none; border-bottom: solid black 1.0pt; border-right: solid black 1.0pt; mso-border-top-alt: solid black .5pt; mso-border-left-alt: solid black .5pt; mso-border-alt: solid black .5pt; padding: 0in 5.4pt 0in 5.4pt;" valign="top" width="126">
            <p class="MsoNormal" style="text-align: justify;"><span style="font-size: 13.0pt; mso-bidi-font-size: 12.0pt; line-height: 115%; font-family: serif;">&nbsp;</span>{{passport_no_01}}</p>
            </td>
            </tr>
            </tbody>
            </table>
            <p class="MsoNormal">The Ministry would appreciate if the esteemed Embassy/High Commission could kindly endorse necessary visa in their favor.</p>
            <p class="MsoNormal">&nbsp;</p>
            <p class="MsoNormal">The Ministry of Foreign Affairs of the Government of the People&rsquo;s Republic of Bangladesh avails itself of this opportunity to renew to the {{applied_embassy_highcommission}} in {{country_to_visit}} the assurances of its highest consideration.</p>
            <p class="MsoNormal">&nbsp;</p>
            <p class="MsoNormal">&nbsp;</p>
            <p class="MsoNormal">&nbsp;</p>
            <p class="MsoNormal"><span style="mso-spacerun: yes;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Dhaka</span>, {{issuance_date}}</p>
            <p class="MsoNormal"><strong>{{applied_embassy_highcommission}}</strong></p>
            <p class="MsoNormal"><strong>Dhaka</strong></p>',
        ];
    }
}
