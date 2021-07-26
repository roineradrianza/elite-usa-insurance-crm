
<body style='background: #1231ef; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.4; margin: 0; padding: 0; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;'>
    <table border='0' cellpadding='0' cellspacing='0' class='body' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #1231ef;'>
      <tr>
        <td style='font-size: 16px; vertical-align: top;'>&nbsp;</td>
        <td class='container' style='font-size: 16px; vertical-align: top; display: block; Margin: 0 auto; max-width: 580px; padding: 10px; width: 580px;'>
          <div class='content' style='box-sizing: border-box; display: block; Margin: 0 auto; max-width: 580px; padding: 10px;'>

            <!-- START CENTERED WHITE CONTAINER -->
            <table class='main' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; background: #ffffff; border-radius: 3px;'>
              <td style="display: flex;">
                <img src='<?php echo esc_url( wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0] ) ?>' style="width:35%; max-width: 200px; margin:auto;"></img>                
              </td>
              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class='wrapper' style=' font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 20px;'>
                  <table border='0' cellpadding='0' cellspacing='0' style='border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;'>
                    <tr>
                      <td style='font-size: 16px; vertical-align: top;'>
                        <p style="text-align: center">A new document has been requested. Document requested:  </p>
                        <p style="text-align: center;">"<?php echo $document ?>"</p>
                        <p style="text-align: center;"> 
                          <a href="<?php echo site_url('/'. $quote_url . '/?quotation_id=' . $id) ?>" target='_blank' style='display: inline-block; color: #ffffff; background-color: #1231ef; border: solid 1px #1231ef; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #1231ef;'> Go to Quote</a>
                        </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
      </tr>
  </table>
</body>