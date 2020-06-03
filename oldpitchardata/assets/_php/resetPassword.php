<?php
$verifyEmailTemp="<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>
<html lang='en'>

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Robot'/>

<body style='background:#ffffff ;font-family:Roboto,sans-serif; font-size:16px; margin:0;'>

  <table style='table-layout: fixed;width:100%; max-width:540px; font-size:16px; margin:0 auto;'>

    <!--- Header --->

    <tr>
      <td colspan='3' style='padding:0;'>
        <table style='border-bottom: 1px solid #e9e9e8;width:100%;table-layout: fixed;'>
          <tr>
            <td align='left' style='padding:32px 32px 16px 32px;font-weight:bold;'>
             <p>PITCHAR.IO</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>

    <!--- Content --->

    <tr>
      <td colspan='3' style='padding:32px'>
        <table>
          <tr>
            <td>
              <table>
                <tr>
                  <td style='padding-bottom:8px;'>
                    <span style='font-size:30px; font-weight:500; color:#0e1830;'>Reset Your Password</span>
                  </td>
                </tr>

                <tr>
                  <td colspan='3' style='padding-bottom:16px;'>
                    <p style='-webkit-margin-before:0em; -webkit-margin-after:0em;font-size:16px; color:rgba(14, 24, 48, 0.5); line-height:22px;'>Hey {$getfname}, Please follow this link to change your password.</p>
                  </td>
                </tr>

                <tr>
                  <td colspan='3' style='padding:16px 0px'>
                    <a href='https://pitchar.io/resetPassword.php?email=$email&token=$token' style='min-width:131px; border-radius:25px; background-color:#49b6c2; text-decoration:none; font-weight:500; font-style:normal; font-stretch:normal; line-height:1; letter-spacing:normal; text-align:center; padding:16px 31px; color:#ffffff;'>Verify Email
                    </a>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td colspan='3' style='padding-top: 32px'>
              <table style='table-layout: fixed'>
                <tr>
                  <td style='color:#0e1830; font-weight:700; padding-bottom:4px;'>Didn't expect this email?
                  </td>
                </tr>
                <tr>
                  <td>
                    <p style='-webkit-margin-before:0em; -webkit-margin-after:0em;font-size: 16px;color: rgba(14, 24, 48, 0.5);line-height: 22px;'>Don't worry, your address may have been entered by mistake. If you ignore this email, nothing further will happen.
                    </p>
                  </td>
                </tr>
              </table> 
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>";


?>