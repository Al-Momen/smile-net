<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeneralSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $email_template = '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--<![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title></title>
        <style type="text/css">
      .ReadMsgBody { width: 100%; background-color: #ffffff; }
      .ExternalClass { width: 100%; background-color: #ffffff; }
      .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; }
      html { width: 100%; }
      body { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; margin: 0; padding: 0; }
      table { border-spacing: 0; table-layout: fixed; margin: 0 auto;border-collapse: collapse; }
      table table table { table-layout: auto; }
      .yshortcuts a { border-bottom: none !important; }
      img:hover { opacity: 0.9 !important; }
      a { color: #0087ff; text-decoration: none; }
      .textbutton a { font-family: "open sans", arial, sans-serif !important;}
      .btn-link a { color:#FFFFFF !important;}
      
      @media only screen and (max-width: 480px) {
      body { width: auto !important; }
      *[class="table-inner"] { width: 90% !important; text-align: center !important; }
      *[class="table-full"] { width: 100% !important; text-align: center !important; }
      /* image */
      img[class="img1"] { width: 100% !important; height: auto !important; }
      }
      </style>
      
      
      
        <p><table width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#414a51" align="center">
          <tbody><tr>
            <td height="50"><br></td>
          </tr>
          <tr>
            <td style="text-align:center;vertical-align:top;font-size:0;" align="center">
              <table cellspacing="0" cellpadding="0" border="0" align="center">
                <tbody><tr>
                  <td width="600" align="center">
                    <!--header-->
                    <table class="table-inner" width="95%" cellspacing="0" cellpadding="0" border="0" align="center">
                      <tbody><tr>
                        <td style="border-top-left-radius:6px; border-top-right-radius:6px;text-align:center;vertical-align:top;font-size:0;" bgcolor="#0087ff" align="center">
                          <table width="90%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody><tr>
                              <td height="20"><br></td>
                            </tr>
                            <tr>
                              <td style="font-family: "Open sans", Arial, sans-serif; color:#FFFFFF; font-size:16px; font-weight: bold;" align="center"><div align="center"><a href="https://premium.appdevs.net/xpay/admin/dashboard" class="sidebar__main-logo"><img src="https://premium.appdevs.net/xpay/assets/images/logoIcon/light_logo.png" alt="image"></a><br></div></td>
                            </tr>
                            <tr>
                              <td height="20"><br></td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                    <!--end header-->
                    <table class="table-inner" width="95%" cellspacing="0" cellpadding="0" border="0">
                      <tbody><tr>
                        <td style="text-align:center;vertical-align:top;font-size:0;" bgcolor="#FFFFFF" align="center">
                          <table width="90%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody><tr>
                              <td height="35"><br></td>
                            </tr>
                            <!--logo-->
                            <tr>
                              <td style="vertical-align:top;font-size:0;" align="center">
                                
                              <br></td>
                            </tr>
                            <!--end logo-->
                            <tr>
                              <td height="40"><br></td>
                            </tr>
                            <!--headline-->
                            <tr>
                              <td style="font-family: "Open Sans", Arial, sans-serif; font-size: 22px;color:#414a51;font-weight: bold;" align="center">Hello {{fullname}}<br></td>
                            </tr>
                            <!--end headline-->
                            <tr>
                              <td style="text-align:center;vertical-align:top;font-size:0;" align="center">
                                <table width="40" cellspacing="0" cellpadding="0" border="0" align="center">
                                  <tbody><tr>
                                    <td style=" border-bottom:3px solid #0087ff;" height="20"><br></td>
                                  </tr>
                                </tbody></table>
                              </td>
                            </tr>
                            <tr>
                              <td height="20"><br></td>
                            </tr>
                            <!--content-->
                            <tr>
                              <td style="font-family: "Open sans", Arial, sans-serif; color:#7f8c8d; font-size:16px; line-height: 28px;" align="left">{{message}}</td>
                            </tr>
                            <!--end content-->
                            <tr>
                              <td height="40"><br></td>
                            </tr>
                    
                          </tbody></table>
                        </td>
                      </tr>
                      <tr>
                        <td style="border-bottom-left-radius:6px;border-bottom-right-radius:6px;" height="45" bgcolor="#f4f4f4" align="center">
                          <table width="90%" cellspacing="0" cellpadding="0" border="0" align="center">
                            <tbody><tr>
                              <td height="10"><br></td>
                            </tr>
                            <!--preference-->
                            <tr>
                              <td class="preference-link" style="font-family: "Open sans", Arial, sans-serif; color:#95a5a6; font-size:14px;" align="center">
                                © 2022 AppDevs . All Rights Reserved. 
                              </td>
                            </tr>
                            <!--end preference-->
                            <tr>
                              <td height="10"><br></td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                    </tbody></table>
                  </td>
                </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td height="60"><br></td>
          </tr>
        </tbody></table></p>';

        $sms_config = '{"from": "----------------------", "name": "clickatell", "apiv2_key": "-------------------------------", "auth_token": "---------------------------", "account_sid": "-----------------------", "nexmo_api_key": "----------------------", "infobip_password": "----------------------", "infobip_username": "--------------", "nexmo_api_secret": "----------------------", "clickatell_api_key": "----------------------------", "text_magic_username": "-----------------------", "message_bird_api_key": "-------------------", "sms_broadcast_password": "-----------------------------", "sms_broadcast_username": "----------------------"}';

        $mail_config = '{"enc": "ssl", "host": "appdevs.net", "name": "smtp", "port": "587", "password": "QP2fsLk?80Ac", "username": "noreply@appdevs.net"}';

        DB::table('general_settings')->insert([
           'sitename'   => 'AppDevs Solution', 
           'site_sub_title'   => 'Quality Mind Development', 
           'dark'   => '0',
           'cur_text' => 'USD',
           'email_from' => 'noreply@appdevs.net',
           'sms_api'    => 'hi {{name}}, {{message}}',
           'base_color' => '#23970c',
           'secondary_color' => '#2030ac',
           'component_color' => '#d41616',
           'mail_config'    => $mail_config,
           'sms_config' => $sms_config,
           'ev' => 1,
           'en' => 1,
           'sv' => 1,
           'sn' => 1,
           'otp_expiration' => 60,
           'otp_verification' => 0,
           'force_ssl' => 1,
           'secure_password' => 1,
           'agree' => 1,
           'registration' => 1,
           'withdraw_status' => 1,
           'deposit_status' => 1,
           'kyc_verification' => 1,
           'devlopment_mode' => 0,
           'active_template' => 'basic',
           'email_template' => $email_template,
           'fiat_currency_api' => '14360e0ed85986d6bf9c3aa1a7fd85080000',
           'crypto_currency_api' => 'f45ece6d-9f1a-4ed5-841c-647a603d4c0800000',
           'qr_template' => '617569babbeb21635084730.png',
           'cron_run' => '{"fiat_cron":"2021-10-24T13:28:21.505940Z","crypto_cron":"2021-10-24T13:28:16.481555Z"}',
           'created_at' => now(),

        ]);
    }
}
