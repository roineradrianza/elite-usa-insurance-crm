<?php if ($coverage_type == 'FAMILY'): ?>
<H3 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_qt5n0trpd0ys"></A>
<FONT COLOR="#1231ef"><FONT FACE="Roboto, serif"><FONT SIZE=5 STYLE="font-size: 16pt"><B>SPOUSE INFORMATION</B></FONT></FONT></FONT></H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<BR><BR>
</P>
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>APPLICANT:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php if ( !empty($espouse_information['added']) && $espouse_information['added'] == 1 ) { echo 'Yes'; } else { echo "No";}?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>GENDER:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php if ( !empty($espouse_information['gender']) && $espouse_information['gender'] == 'M' ) { echo 'Male'; } else if ( !empty($espouse_information['gender']) && $espouse_information['gender'] == 'F' ) { echo 'Female'; }?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>BIRTHDATE:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo date_format(date_create($espouse_information['birthdate']),"m/d/Y") ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>AGE:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $espouse_information['age'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>FULL
NAME:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo "{$espouse_information['first_name']} {$espouse_information['middle_name']} {$espouse_information['last_name']}" ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>PHONE
NUMBER:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $espouse_information['telephone'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>SOCIAL
SECURITY NUMBER (SSN): </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $espouse_information['ssn'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<?php if (!$espouse_information['is_citizen']) : ?>
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
INMIGRATION STATUS: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo !empty($espouse_information['inmigration_status_selected']) ? $espouse_information['inmigration_status_selected'] : $espouse_information['inmigration_status'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">	
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
UCIS NUMBER: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">A-<?php echo $espouse_information['uscis_number'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">	
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
CARD NUMBER: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $espouse_information['card_number'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">	
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
CATEGORY: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $espouse_information['category'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
DOCUMENT FROM: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $espouse_information['document_from'] ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">	
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>
DOCUMENT EXPIRATION DATE: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo date_format(date_create($espouse_information['document_expires']),"m/d/Y") ?></FONT></FONT></P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">	
<?php endif ?>
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>COUNTRY
OF BIRTH:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
<?php echo $espouse_information['birth_country'] ?></FONT></FONT></P>
<H3 CLASS="western" STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto"><A NAME="_xjjjdx1i32w5"></A>
<FONT COLOR="#333333"><FONT FACE="Roboto, serif"><FONT SIZE=5 STYLE="font-size: 16pt"><B>EMPLOYMENT
INFORMATION</B></FONT></FONT></FONT></H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>IS EMPLOYED: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['is_employed'] ? 'YES' : 'NO' ?></FONT></FONT></P>
	<?php if ($employment_information['is_employed']): ?>
		<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>TYPE
		OF WORK: </B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['work_type'] ?></FONT></FONT></P>
		<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
		 <?php if ($employment_information['work_type'] == 'W2'): ?>
			<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>COMPANY:
			</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['employer'] ?></FONT></FONT></P>
			<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
		 <?php endif ?>
		<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>INCOME:
		</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['income'] ?>$</FONT></FONT></P>
		<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
		<FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt"><B>PAYMENT
		BY:</B></FONT></FONT><FONT FACE="Roboto, serif"><FONT SIZE=2 STYLE="font-size: 10pt">
		<?php echo $employment_information['payment_by'] ?></FONT></FONT></P>
	<?php endif ?>
<HR>
<?php endif ?>