<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width"/>
   </head>
   <body  style="margin: 0; padding: 0; font-size: 100%; font-family: 'Avenir Next', "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; line-height: 1.65;">
      <table class="body-wrap" style="width: 100% !important; height: 100%; background: #efefef; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none;">
         <tr>
            <td class="container" style="display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important;">
               <table style="width: 100% !important; border-collapse: collapse;">
                  <tr>
                     <td align="center" class="masthead" style="padding: 80px 0; background: #37b0bc; color: white;">
                        <h1 style="margin-bottom: 20px; line-height: 1.25; font-size: 32px; margin: 0 auto !important; max-width: 90%; text-transform: uppercase;"><?php echo $_ENV["MAIL_ENTERPRISE"]; ?> - RESUMO DE VENDAS</h1>
                     </td>
                  </tr>
                  <tr>
                     <td class="content" style="background: white; padding: 30px 35px;">
                        <h2 style="margin-bottom: 20px; line-height: 1.25; font-size: 28px;">Olá, <?php echo $data['seller'] ?></h2>
                        <p style="font-size: 16px; font-weight: normal; margin-bottom: 20px;">Sua comissão de vendas hoje foi de: R$<strong><?php echo round($data['comission'], 2); ?></strong></p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
         <tr>
            <td class="container" style="background: #37b0bc; display: block !important; clear: both !important; margin: 0 auto !important; max-width: 580px !important;">
               <table>
                  <tr>
                     <td class="content footer" style="background: white; padding: 30px 35px; background: none;" align="center">
                        <p style="margin-bottom: 0; color: #000; text-align: center; font-size: 14px;">Resumo de vendas do dia <strong><?php echo date('d/m/Y'); ?></strong></p>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>
