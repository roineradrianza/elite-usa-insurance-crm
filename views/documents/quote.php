<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<STYLE TYPE="text/css">
<!--
  @page { margin: 1in }
  P { margin-bottom: 0.08in }
  H3 { margin-top: 0.22in; margin-bottom: 0.06in; direction: ltr; color: #434343; line-height: 100%; page-break-inside: avoid; widows: 2; orphans: 2 }
  H3.western { font-family: "Arial", serif; font-weight: normal }
  H3.cjk { font-family: "Arial"; font-weight: normal }
  H3.ctl { font-family: "Arial"; font-weight: normal }
  H4 { margin-top: 0.19in; margin-bottom: 0.06in; direction: ltr; color: #666666; line-height: 100%; page-break-inside: avoid; widows: 2; orphans: 2 }
  H4.western { font-family: "Arial", serif; font-weight: normal }
  H4.cjk { font-family: "Arial"; font-weight: normal }
  H4.ctl { font-family: "Arial"; font-weight: normal }
-->
</STYLE>
<BODY LANG="en-US" DIR="LTR">
<?php if (!empty($data['ID'])): ?>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt;"><B>Quote ID: <?php echo $data['ID'] ?> </B>    
<?php endif ?>
<?php echo $affordable_care_act['deductible'] ?></FONT></FONT></P>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('documents/quote/affordable_care_act', ['affordable_care_act' =>$data['affordable_care_act']]) ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('documents/quote/personal_information', ['personal_information' => $data['personal_information'], 'employment_information' => $data['employment_information'], 'applicant' => $data['applicant']]) ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('documents/quote/espouse_information', ['espouse_information' => $data['espouse_information'], 'employment_information' => $data['espouse_employment_information'], 'applicant' => $data['applicant'], 'coverage_type' => $data['affordable_care_act']['coverage_type']]) ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('documents/quote/dependents', ['dependents' => $data['dependents'], 'coverage_type' => $data['affordable_care_act']['coverage_type']]) ?>
<?php echo \RA_ELITE_USA\Controller\Classes\Template::show_template('documents/quote/payment_information', ['payment_information' => $data['payment_information']]) ?>
</BODY>