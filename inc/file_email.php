<?
		require("inc/class.phpmailer.php");
		$mail = new PHPMailer();

		/*email connections*/
		$mail->IsSMTP();                                           // set mailer to use SMTP
		$mail->Host = "mail.citrahost.com";                // specify main and backup server
		$mail->SMTPAuth = true;                                   // turn on SMTP authentication
		$mail->Username = "webmaster@citrahost.com";                           // SMTP username
		$mail->Password = "web12345";                          // SMTP password
		
		$mail->From = "info@jogjastreamers.com";                    // from user
		$mail->FromName = $include_nama_dari;               // from name
		$mail->WordWrap = 100;                                   // word wrap
		$mail->IsHTML(false);                                   //set to html

		$arr_ses_emailData=explode(",",$include_email_tujuan);


		for($a=0;$a < count($arr_ses_emailData); $a++)
			{
			$mail->AddAddress($arr_ses_emailData[$a]);
			}


		$mail->AddReplyTo($include_email_dari, $include_nama_dari);

		// sned a BCC to submitter
		if(!empty($include_email_BCC))
			{
			$arr_ses_emailBCC=explode(",",$include_email_BCC);
			for($a=0;$a < count($arr_ses_emailBCC); $a++)
					{
					$mail->AddBCC($arr_ses_emailBCC[$a]);
					}
			}
		//sublect
		$mail->Subject = "[Jogjastreamers - ".$include_subyek."]";


		//TEXT ONLY
		$mail->Body = $include_pesan;

		if(!$mail->Send())
		{
		   echo "Message could not be sent. <p>";
		   echo "Mailer Error: " . $mail->ErrorInfo;
		   exit;
		}else{
			//header("location:../reservation.php");
		}
?>
