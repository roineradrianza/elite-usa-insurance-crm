<?php if ( count($dependents) > 0 && $coverage_type == 'FAMILY' ): ?>
<H3 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_hvw7e137wxj5"></A>
<FONT COLOR="#1231ef"><FONT FACE="Roboto, serif"><FONT SIZE=5 STYLE="font-size: 16pt"><B>DEPENDENTS</B></FONT></FONT></FONT></H3>
<H4 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_pqb7u954acin"></A>
<BR>
</H4>
<?php $i = 0 ?>
<?php foreach ($dependents as $dependent): $i = $i + 1 ?>
<H4 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_xqy25ke2wags"></A>
<FONT COLOR="#333333"><FONT FACE="Roboto, serif"><FONT SIZE=4 STYLE="font-size: 13pt"><B>Dependent
<?php echo $i ?></B></FONT></FONT></FONT></H4>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>APPLICANT:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php if ( !empty($dependent['added']) && $dependent['added'] == 1 ) { echo 'Yes'; } else { echo "No";}?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>GENDER:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php if ( !empty($dependent['gender']) && $dependent['gender'] == 'M' ) { echo 'Male'; } else if ( !empty($dependent['gender']) && $dependent['gender'] == 'F' ) { echo 'Female'; }?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>BIRTHDATE:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo date_format(date_create($dependent['birthdate']),"m/d/Y") ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>FULL
NAME:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo "{$dependent['first_name']} {$dependent['last_name']}" ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>CITIZEN:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['is_citizen'] ? 'YES' : 'NO' ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">

<?php if (!$dependent['is_citizen']) : ?>
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>INMIGRATION
STATUS:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo !empty($dependent['inmigration_status_selected']) ? $dependent['inmigration_status_selected'] : $dependent['inmigration_status'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>UCIS
NUMBER:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['uscis_number'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>CARD
NUMBER:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['card_number'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>CATEGORY:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['category'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>DOCUMENT
FROM:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['document_from'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>DOCUMENT
EXPIRATION DATE:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo date_format(date_create($dependent['document_expires']),"m/d/Y") ?></FONT></FONT></P>
<?php else: ?>
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>SOCIAL SECURITY NUMBER (SSN):</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $dependent['ssn'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<?php endif ?>
<?php endforeach ?>
<HR>
	
<?php endif ?>