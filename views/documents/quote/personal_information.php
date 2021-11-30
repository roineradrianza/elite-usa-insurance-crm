<H3 CLASS="western"
    STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto">
    <A NAME="_qt5n0trpd0ys"></A>
    <FONT COLOR="#1231ef">
        <FONT FACE="Roboto, serif">
            <FONT SIZE=5 STYLE="font-size: 16pt"><B>PERSONAL
                    INFORMATION</B></FONT>
        </FONT>
    </FONT>
</H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <BR><BR>
</P>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt"><B>APPLICANT:</B></FONT>
</FONT>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt">
        <?php if ( !empty($personal_information['added']) && $personal_information['added'] == 1 ) { echo 'Yes'; } else { echo "No";}?>
    </FONT>
</FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>TOTAL
                FAMILY INCOME:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['total_income'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>GENDER:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php if ( !empty($personal_information['gender']) && $personal_information['gender'] == 'M' ) { echo 'Male'; } else if ( !empty($personal_information['gender']) && $personal_information['gender'] == 'F' ) { echo 'Female'; }?>
        </FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>MARITAL
                STATUS:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['marital_status'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>BIRTHDATE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo date_format(date_create($personal_information['birthdate']),"m/d/Y") ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>AGE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['age'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>FULL
                NAME:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $applicant ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>EMAIL:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['email'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>PHONE
                NUMBER:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['telephone'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CITIZEN:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['is_citizen'] ? 'YES' : 'NO' ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>SOCIAL
                SECURITY NUMBER (SSN): </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['ssn'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <?php if (!$personal_information['is_citizen']) : ?>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                INMIGRATION STATUS: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo !empty($personal_information['inmigration_status_selected']) ? $personal_information['inmigration_status_selected'] : $personal_information['inmigration_status'] ?>
        </FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                UCIS NUMBER: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">A-<?php echo $personal_information['uscis_number'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                CARD NUMBER: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['card_number'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                CATEGORY: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['category'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                DOCUMENT FROM: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['document_from'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>
                DOCUMENT EXPIRATION DATE: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo date_format(date_create($personal_information['document_expires']),"m/d/Y") ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <?php endif ?>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ADDRESS:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['address'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>TYPE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['type'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>STATE:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['state'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>COUNTY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['county'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CITY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo !empty($personal_information['city']) ? $personal_information['city'] : '' ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ZIP
                CODE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['zip_code'] ?></FONT>
    </FONT>
</P>
<?php if(!empty($personal_information['same_address'])) : ?>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 14pt"><B>MAILING ADDRESS:
            </B></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ADDRESS:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['mailing_address'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>TYPE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['mailing_type'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>STATE:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $personal_information['mailing_state'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>COUNTY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['mailing_county'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CITY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo !empty($personal_information['mailing_city']) ? $personal_information['mailing_city'] : '' ?>
        </FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ZIP
                CODE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['mailing_zip_code'] ?></FONT>
    </FONT>
</P>
<?php endif ?>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>COUNTRY
                OF BIRTH:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $personal_information['birth_country'] ?></FONT>
    </FONT>
</P>
<H3 CLASS="western"
    STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto">
    <A NAME="_xjjjdx1i32w5"></A>
    <FONT COLOR="#333333">
        <FONT FACE="Roboto, serif">
            <FONT SIZE=5 STYLE="font-size: 16pt"><B>EMPLOYMENT
                    INFORMATION</B></FONT>
        </FONT>
    </FONT>
</H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>TYPE
                OF WORK: </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['work_type'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <?php if ($employment_information['work_type'] == 'W2'): ?>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>COMPANY:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['employer'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <?php endif ?>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>INCOME:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $employment_information['income'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>PAYMENT
                BY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $employment_information['payment_by'] ?></FONT>
    </FONT>
</P>
<HR>