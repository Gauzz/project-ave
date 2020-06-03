<?php   
       $req= require("../class.phpmailer.php");
       //if($req){echo "conn";}
        
  $error="";
 $to_email = "mayankneema02@gmail.com";
 
 if(empty($to_email))
 {
	$error .= 'Por favor ingrese la ID de correo'; 
 }elseif(!filter_var($to_email, FILTER_VALIDATE_EMAIL)) {
      $error .= "Formato de correo inv&#225;lido
";
    }
    else
	{
 //   $message = '<div style="width:50%;margin:auto;background:#93814f; box-shadow: 0 0 45px #56a7a2;border-radius: 80px 0;"><h1 style="color: #fff;font-size: 39px;font-weight: bold;padding-top: 56px;text-align: center;">Estas Invitado</h1><div style="margin: auto;width: 50%;"></div><p style=" color: #fff;font-size: 18px;padding: 7px 55px;text-align: justify;">Hola '.$_POST['name'].',<br> Te quiero invitar a visitar este portal <br> donde puedes retar a tu amigos, retarte a ti mismo y obtener compensaciones en dinero '.'<a href="'.site_url.'">  Click Here</a>'.'<br>'.'ThankYou'.'</p><span style="display: block;font-size: 32px;font-weight: bold;padding: 10px 40px 40px;text-align: center;"> </span></div>';
	
	  $message ='<body style="background: #f2f2f2;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;"><div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">	<div style="color: #444444;font-weight: normal;"><div style="background:url('.site_url.'img/Untitled-2.jpg);background-size:cover;padding-bottom:30px;padding-top:80px;text-align:center;"><img style="width:150px;" src="'.site_url.'img/mail_logo.png"><h4 style="color:#fff;margin-top:5px;">retos para transformar vidas</h4></div><div style="color: #444444;font-weight: normal;text-align:center;"><p style="text-align:center;width:70%;margin: 20px auto;">Edwin Tamayo te ha  invitado para que conozcas <a href="'.site_url.'" style="text-decoration:none;color:red">dreamgraphs.com</a>,una herramienta para que las personas apoyen e incentiven a sus amigos, familiares y colegas  a cambiar sus vidas por medio	de la ejecuci¨®n de retos . <br><br>	Y al cumplir estos retos , se pueden otorgar obsequisios econ¨®micos por los logros obtenidos.</p>	<p style="font-weight:bold;color: #23925f;font-size: 17px;font-weight: bold;text-align: center;">cumpleanos?. no regales una torta, regala un reto !!!!</p></div>	<div style="clear:both"></div></div> <div style="padding: 10px 30px;background:#05858b;text-align:center;margin-top:70px;"><div style="color: #fff;font-weight:bold;">dreamgraphs s.a.s</div><div style="color: #fff">Medelin Colombia</div><div style="color: #fff">2018</div></div></div></body>';

// echo $message;exit;
    $mail = new PHPMailer();

    $mail->IsSMTP();  // telling the class to use SMTP
    $mail->SMTPAuth   = true; // SMTP authentication
    $mail->Host       = "smtp.sendgrid.net"; // SMTP server
    $mail->Port       = 587; // SMTP Port
    $mail->Username   = "apikey"; // SMTP account username
    $mail->Password   = "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";        // SMTP account password

    $mail->SetFrom('makeritampm@gmail.com', 'makerites'); // FROM
    $mail->AddReplyTo(); // Reply TO

    $mail->AddAddress($to_email); // recipient email

    $mail->Subject    = 'Invitation'; // email subject
    $mail->msgHTML($message); 
  //echo  $mail; exit();
    if(!$mail->Send()) {
      echo 'Message was not sent.';
      echo 'Mailer error: ' . $mail->ErrorInfo;
    } else {
      echo 'Message has been sent.';
    }
	}
?>

 
