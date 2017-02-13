<?php
 
ini_set("include_path", '/home/sankalp20/php:' . ini_get("include_path") );
require_once "Mail.php";
require_once "Mail/mime.php";
 
function sendRecoveryMail($email,$password)
{
    $from = "Wave Carrier Institute<no-reply@wavecarrierinstitute.com>";
    $to = $email;
    $subject = "Password recovery Mail";
    $txt = "Visit this link to reset password:\n".
           "http://wavecarrierinstitute/student/resetpassword.php?email=$email&id=$password".
           "\n\nNote: Ignore this mail if you haven't requested for password reset.";
    $html = "<p>Visit this link to reset password:<br>".
           "<a href=\"http://wavecarrierinstitute/student/resetpassword.php?email=$email&id=$password\">".
           "Click here to reset password.</a>".
           "<br><br>Note: Ignore this mail if you haven't requested for password reset."; 
    
    $host = "ssl://sg2plcpnl0251.prod.sin2.secureserver.net";
    $port = "465";
    $username = "no-reply@wavecarrierinstitute.com";
    $password = "no-reply";
    $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);

    $mime = new Mail_mime('\n');
    $mime->setTXTBody($txt);
    $mime->setHTMLBody($html);
    
    $body = $mime->get();
    $headers = $mime->headers($headers);
    
    $smtp = Mail::factory('smtp',
    array ('host' => $host,
            'port' => $port,
            'auth' => true,
            'username' => $username,
            'password' => $password));
    
    $mail = $smtp->send($to, $headers, $body);
    
    if (PEAR::isError($mail)) 
    {
        echo("<p>" . $mail->getMessage() . "</p>");
    } 
    else 
    {
        //echo("<p>Message successfully sent!</p>");
        return TRUE;
    }

}