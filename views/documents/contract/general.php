<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>First
Name: <U><?php echo $data['first_name'] ?></U></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Last
Name: <U><?php echo $data['last_name'] ?></U></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Date
of Birth: <U><?php echo date_format(date_create($data['birthdate']),"m/d/Y") ?></U></FONT></FONT></P>
<P STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>S.S.N:
<U><?php echo $data['ssn'] ?></U> </FONT></FONT>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Independent
or Agency Health License Number: <U><?php echo $data['license_number'] ?></U> </FONT></FONT>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Address: <U><?php echo $data['address'] ?></U></FONT></FONT></P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>City:
<U><?php echo $data['city'] ?></U> State: <U><?php echo $data['state'] ?></U> </FONT></FONT>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Zip
Code: <U><?php echo $data['zip_code'] ?></U> </FONT></FONT>
</P>
<P ALIGN=JUSTIFY STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Phone
Number: <U><?php echo $data['phone_number'] ?></U></FONT></FONT></P>
<P STYLE="margin-bottom: 0.11in; line-height: 150%"><FONT FACE="Arial, serif"><FONT SIZE=3>Personal
E-Mail: <U><?php echo $data['email'] ?></U> </FONT></FONT>
</P>