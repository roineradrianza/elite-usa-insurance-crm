<?php if ($payment_information['type'] != '') : ?>
<H3 CLASS="western"
    STYLE="margin-top: 0in; margin-bottom: 0in; background: #ffffff; border: none; padding: 0in; line-height: 100%; page-break-inside: auto; page-break-after: auto">
    <A NAME="_tbrgc77ibb1z"></A>
    <FONT COLOR="#1231ef">
        <FONT FACE="Roboto, serif">
            <FONT SIZE=5 STYLE="font-size: 16pt"><B>PAYMENT
                    INFORMATION</B></FONT>
        </FONT>
    </FONT>
</H3>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <BR><BR>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>PAYMENT
                TYPE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['type'] ?></FONT>
    </FONT>
</P>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt"><B>AUTOPAY:</B></FONT>
</FONT>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt">
        <?php echo !empty($payment_information['autopay']) && $payment_information['autopay'] ? 'YES' : 'NO' ?></FONT>
</FONT>
</P>
<?php if(!empty($payment_information['autopay']) && $payment_information['autopay'] && !empty($payment_information['autopay_date']) ) : ?>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt"><B>PAYMENT DATE:</B></FONT>
</FONT>
<FONT FACE="Roboto, serif">
    <FONT SIZE=2 STYLE="font-size: 10pt">
        <?php echo date_format(date_create($payment_information['autopay_date']), "m/d/Y") ?></FONT>
</FONT>
</P>
<?php endif ?>
<?php if ($payment_information['type'] == 'CREDIT OR DEBIT CARD'): ?>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>NAME
                ON CARD:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['card']['name'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>TYPE:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">DEBIT
            (<?php echo $payment_information['card']['type'] ?>)</FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CARD
                NUMBER:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['card']['number'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>DATE
                OF EXPIRATION:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo date_format(date_create($payment_information['card']['expiration_date']),"m/Y") ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CODE(CCV):
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $payment_information['card']['ccv'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>BANK
                NAME:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['card']['bank_name'] ?></FONT>
    </FONT>
</P>

<?php endif ?>
<?php if ($payment_information['type'] == 'BANK ACCOUNT'): ?>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ACCOUNT TYPE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['bank']['type'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>BANK NAME:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $payment_information['bank']['name'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>NAME ON ACCOUNT:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['bank']['owner_name'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ROUTING NUMBER:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['bank']['routing_number'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ACCOUNT NUMBER:
            </B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><?php echo $payment_information['bank']['account_number'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>CITY:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['bank']['city'] ?></FONT>
    </FONT>
</P>
<P STYLE="margin-bottom: 0.17in; background: #ffffff; border: none; padding: 0in; line-height: 100%">
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt"><B>ESTATE:</B></FONT>
    </FONT>
    <FONT FACE="Roboto, serif">
        <FONT SIZE=2 STYLE="font-size: 10pt">
            <?php echo $payment_information['bank']['estate'] ?></FONT>
    </FONT>
</P>

<?php endif ?>
<HR>
<?php endif ?>