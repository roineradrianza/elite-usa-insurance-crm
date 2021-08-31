<H3 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_cwdsoa97kabs"></A>
<FONT COLOR="#1231ef"><FONT FACE="Roboto, serif"><FONT SIZE=5 STYLE="font-size: 16pt"><B>AFFORDABLE
CARE ACT</B></FONT></FONT></FONT></H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<BR><BR>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>CLIENT TYPE:</B> <?php echo !empty($affordable_care_act['client_type']) ? $affordable_care_act['client_type'] : '' ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>DATE OF EFFECTIVENESS:</B> <?php echo !empty($affordable_care_act['effectiveness_date']) ? date_format(date_create($affordable_care_act['effectiveness_date']),"m/d/Y") : '' ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>MONTLY
SUBSIDY / MONTHLY FISCAL CREDIT:</B> <?php echo $affordable_care_act['mfc'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>COMPANY:</B> <?php echo $affordable_care_act['company_plan'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B></B>PLAN:</B> <?php echo !empty($affordable_care_act['plan']) ? $affordable_care_act['plan'] : '' ?>
</FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>PREMIUM:</B>
<?php echo $affordable_care_act['premium'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>DEDUCTIBLE:</B>
<?php echo $affordable_care_act['deductible'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>MOOP:</B>
<?php echo $affordable_care_act['moop'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>AGENT
NAME:</B> <?php echo $affordable_care_act['agent_name'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>COVERAGE
TYPE:</B> <?php echo $affordable_care_act['coverage_type'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>NUMBER
OF MEMBERS ON COVERAGE:</B> <?php echo $affordable_care_act['coverage_nro_members'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>DATE:</B>
<?php echo date_format(date_create($affordable_care_act['date']),"m/d/Y H:i:s") ?></FONT></FONT></P>
<hr>