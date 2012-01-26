<?php

//wrapper class for PEAR's Mail
//@note PHP mail(), swiftmailer & phpmailer sucks
//@see http://www.phpmaniac.net/wiki/index.php/Pear_Mail
class Sendmail {

  var $mail;
  var $mime;
  var $error;
  var $data;
  var $text='You need a HTML compatible email client.';

  function __construct($user=false,$pass=false,$host='localhost',$port=25) {
    require('Mail.php');
    require('Mail/mime.php');
    if ($host && $port && $host && $port) {
        $smtp['host']=$host;
        $smtp['port']=$port;
        $smtp['auth']=true;
        $smtp['username']=$user;
        $smtp['password']=$pass;
        $this->mail =& Mail::factory('smtp', $smtp);
    } else {
        $this->mail =& Mail::factory('mail');
    }
  }
  
  function send($to, $subject, $message, $from, $ccfrom=0) {
    if (!$from) { $this->error='Missing from address.'; return false; }
    $crlf="\n";
    $headers=array();
    $headers['From']=$from;
    $headers['Return-Path']=$from;
    $headers['Subject']=$subject;
    $headers['X-REMOTE_ADDR']=isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'null';
    $headers['X-Mailer']=isset($_SERVER['HTTP_USER_AGENT'])?$_SERVER['HTTP_USER_AGENT']:'null';
    $this->mime = new Mail_mime($crlf);
    $this->mime->setTXTBody($this->text);
    $this->mime->setHTMLBody($message);
    $message=$this->mime->get();
    $headers=$this->mime->headers($headers);
    $result=$this->mail->send($to, $headers, $message);
    if ($result) {return true;}
    else {$this->error=$result;}
  }
  
	function render($file) {
		if (!file_exists($file)) { return; }
    if (is_array($this->data)) { extract($this->data); }
		ob_start();
		include($file);
		$out = ob_get_contents();
		ob_end_clean();
		return $out;
	}

}
