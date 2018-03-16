<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<style>p{margin:10px 0;}</style>
</head>

<body>
<table width="670" border="0" cellspacing="0" cellpadding="0" bgcolor="#4476a7">
  <tbody>
  
    <tr>
      <td align="center" height="160"><img src="<?php echo SITE_URL; ?>assets/images/emaillogo.png" width="142" height="108" style="display:block" alt="logo"  /></td>
    </tr>
    <tr>
      <td style="padding:10px;">
            <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#fff">
              <tbody>
                <tr>
                  <td style="padding:20px; font-family: 'open sans', 'helvetica neue', sans-serif;">
                 <?php if($email_p == 'lawfirm_reg'){ ?>
                        <p>Hello,</p>

                        <p>Thanks for your request.here is the few more steps to complete registration</p>

                         <p><b>Click the below button : </b></p>


                        <p><a href="<?php echo SITE_URL.'lawfirm/register/'.$id.'/'.$code; ?>" style="width: 200px;height: 48px;background: #4383bf;color: #fff;font-family: 'open_sansbold';border: none;margin-right: 15px;text-decoration: none;padding:8px;" target="_blank">Lawfirm Registration</a></p>

                     

                        <p>Sincerely,</p>

                        <p>The LawBench Team<br>
                        <a href='<?php echo SITE_URL; ?>'>www.LawBench.com</a></p>
                      <?php }else  if($email_p == 'login_cred'){ ?>
                         <p>Hello <?php echo $username; ?>,</p>

                        <p>We activated your account on lawbench.com. Please use the following information to log in to your account.</p>

                      
                        <p style="line-height:2.2em;">
                          Email: <span style="color:#4476a7;"><?php echo $email; ?></span><br>
                          Username: <span style="color:#4476a7;"><?php echo $username; ?></span><br>
                          Password: <span style="color:#4476a7;"><?php echo $password; ?></span>
                        </p>
              
                        <p>Thank you for choosing LawBench.</p>

                        <p>Sincerely,</p>

                        <p>The LawBench Team<br>
                        <a href='<?php echo base_url(); ?>'>www.LawBench.com</a></p>

                       <?php }else if($email_p == 'que_refund_success'){ ?>

                           <p>Hello <?php echo $name; ?>,</p>
                           
                           <p><?php echo $message; ?></p>
                          
                         

                          <p>Sincerely,</p>

                          <p>The LawBench Team<br>
                          <a href="<?php echo base_url(); ?>" target="_blank">www.LawBench.com</a></p>
                      <?php } ?>
                     
                  </td>
                </tr>
              </tbody>
            </table>
      </td>
    </tr>
    
    
    

    <tr>
      <td align="center" height="80" style="color:#fff; font-family: 'open sans', 'helvetica neue', sans-serif;">Copyright © 2017 Path2usa.com, Inc. All rights reserved.</td>
    </tr> 
    
  </tbody>
</table>

</body>
</html>
