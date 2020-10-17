<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function __construct() {
//        parent::__construct();
//        echo "123";exit;
        require './PHPMailer/Exception.php';
        require './PHPMailer/PHPMailer.php';
        require './PHPMailer/SMTP.php';
    }

    public function send_email($to,$subject,$message,$attach=0,$cc="",$attachM = array())
	{

        // date_default_timezone_set('Etc/UTC');

        // =============

		// $query = $this->ci->db->select('*')->get('emailsettings');
		// $email_setting = $query->row();

		// $smtpUsername = $email_setting->smtp_username;
		// $smtpPassword = $email_setting->smtp_password;
		
		// $emailFrom = $email_setting->from_email;   
		// $emailFromName = $email_setting->from_name;
        
        // $host = $email_setting->smtp_host;
        // $port = $email_setting->smtp_port;

		// $smtp_secure = '';
		// if($email_setting->smtp_secure == '0'){
		// 	$smtp_secure = 'tls';
		// }else{
		// 	$smtp_secure = 'ssl';
        // }

        // ============

  //       $smtpUsername = "_mainaccount@igeekteam.net";
  //       $smtpPassword = "R7qJxtd1@O";

  //       $emailFrom = "nikul@kartuminfotech.com";
  //       $emailFromName = "";

  //       $host = "ssl://smtp.gmail.com";
  //       $port = "";

  //       $smtp_secure = "";

  //       // =============

  //       $emailTo = $to;
  //       $emailToName = '';

		// $mail = new PHPMailer;
		// $mail->isSMTP(); 
		// $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
		// $mail->Host = $host; // use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
		// $mail->Port = $port; // TLS only
		// // $mail->SMTPSecure = $smtp_secure; // ssl is depracated
		// // $mail->smtp_crypto = $smtp_secure; // ssl is depracated
		// $mail->SMTPAuth = true;
		// $mail->Username = $smtpUsername;
		// $mail->Password = $smtpPassword;
		// $mail->setFrom($emailFrom, $emailFromName);
		// $mail->addAddress($emailTo, $emailToName);
		// $mail->Subject = $subject;
		// $mail->msgHTML($message); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
		// $mail->AltBody = 'HTML messaging not supported';
		// if($attach !== 0){

		// 	// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));	
		// 	// echo $newurl."<br/>";
		// 	$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
		// 	$mail->addAttachment($newurl);
		// }
		// if(!empty($attachM)){
		// 	// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));	
		// 	// echo $newurl."<br/>";
		// 	foreach($attachM as $attach){
		// 		$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
		// 		$mail->addAttachment($newurl);
		// 	}
		// }

		// if($cc != ""){
		// 	//$mail->AddCC($cc);
		// 	$ccAry = explode(',',$cc);
		// 	foreach($ccAry as $ccEmail){
		// 		$mail->AddCC($ccEmail);
		// 	}
		// }

		// if(!$mail->send()){
		// 	// echo "11";exit;
		// 	// echo "<pre>";print_r($mail);exit;
		// 	echo "Mailer Error: " . $mail->ErrorInfo;exit;
  //           return FALSE;
		// }else{
		// 	// echo "22";exit;
		// 	return TRUE;
		// }

		// ===========================

		//PHPMailer Object
	    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

	    //From email address and name
	    $mail->From = "dacteam@gmail.com";
	    $mail->FromName = "DAC";

	    // $to = "nikul@kartuminfotech.com";
	    //To address and name
	    $mail->addAddress($to);
	    // $mail->addAddress("recepient1@example.com"); //Recipient name is optional

	    //Address to which recipient will reply
	    // $mail->addReplyTo("dac.igeekteam.net", "Reply");

	    //CC and BCC
	    // $mail->addCC("cc@example.com");

	    // $mail->addBCC("bcc@example.com");
	    //Send HTML or Plain Text email
	    $mail->isHTML(true);

	    $mail->Subject = $subject;
	    $mail->Body = $message;

	    if($attach !== 0){
			// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));	
			// echo $newurl."<br/>";
			$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
			// echo $newurl = $attach;
			// exit;
			$mail->addAttachment($newurl);
		}

	    if(!empty($attachM)){
			// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));	
			// echo $newurl."<br/>";
			foreach($attachM as $attach){
				// $newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
				$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
				$mail->addAttachment($newurl);
			}
		}

	    // $mail->AltBody = "This is the plain text version of the email content";

	    try {
	        $mail->send();
	        return true;
	    } catch (Exception $e) {
	        $error = "Mailer Error: " . $mail->ErrorInfo;
	        return false;
	    }

	}

	public function send_email2($to,$subject,$message,$attach=0,$cc="",$attachM = array())
	{
		//PHPMailer Object
	    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions

	    //From email address and name
	    $mail->From = FROM_EMAIL;
	    $mail->FromName = "CleanBee";

	    // $to = "nikul@kartuminfotech.com";
	    //To address and name
	    $mail->addAddress($to);
	    // $mail->addAddress("recepient1@example.com"); //Recipient name is optional

	    //Address to which recipient will reply
	    // $mail->addReplyTo("dac.igeekteam.net", "Reply");

	    //CC and BCC
	    // $mail->addCC("cc@example.com");

	    // $mail->addBCC("bcc@example.com");
	    //Send HTML or Plain Text email
	    $mail->isHTML(true);

	    $mail->Subject = $subject;
	    $mail->Body = $message;

	    if($attach !== 0){
			// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));
			// echo $newurl."<br/>";
			$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
			// echo $newurl = $attach;
			// exit;
			$mail->addAttachment($newurl);
		}

	    if(!empty($attachM)){
			// $newurl = str_replace(base_url(),$_SERVER["DOCUMENT_ROOT"].'/',rawurldecode($attach));	
			// echo $newurl."<br/>";
			foreach($attachM as $attach){
				// $newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
				$newurl = $_SERVER["DOCUMENT_ROOT"].'/'.$attach;
				$mail->addAttachment($newurl);
			}
		}

	    // $mail->AltBody = "This is the plain text version of the email content";

	    try {
	        $mail->send();
	        return true;
	    } catch (Exception $e) {
	        $error = "Mailer Error: " . $mail->ErrorInfo;
	        return false;
	    }

	}

}

?>