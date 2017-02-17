<?php
 
ini_set("include_path", '/home/sankalp20/php:' . ini_get("include_path"));
require_once "Mail.php";
require_once "Mail/mime.php";
 
function sendRecoveryMail($email,$password)
{
    $from = "Wave Carrier Institute<no-reply@wavecarrierinstitute.com>";
    $to = $email;
    $subject = "Password recovery Mail";
    $txt = "Hello,\nVisit this link to reset password:\n".
           "http://wavecarrierinstitute.com/student/resetpassword.php?email=$email&id=$password".
           "\n\nNote: Ignore this mail if you haven't requested for password reset.";
    $body = "Hello,<br><p>Visit this link to reset password:<br>".
           "<br><a href=\"http://wavecarrierinstitute.com/student/resetpassword.php?email=$email&id=$password\">".
           "Click here to reset password.</a>".
           "<br><br>Note: Ignore this mail if you haven't requested for password reset.</p>"; 
    
    $host = "ssl://sg2plcpnl0251.prod.sin2.secureserver.net";
    $port = "465";
    $username = "no-reply@wavecarrierinstitute.com";
    $password = "no-reply";
    $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);

    $mime = new Mail_mime();
    $mime->setTXTBody($txt);
    $mime->setHTMLBody($body);
    
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

function sendQueryMail($detail)
{
    $from = "Wave Carrier Institute<no-reply@wavecarrierinstitute.com>";
    $to = "info@wavecarrierinstitute.com";
    $subject = "New Query submited on WaveCarrierInstitute.com";
    $txt = "Full name: ".$detail['fname']." ".$detail['lname'].
           "\nEmail Address: ".$detail['email'].
           "\nSubject: ".$detail['subject'].
           "\nMessage: ".$detail['message'];

    $host = "ssl://sg2plcpnl0251.prod.sin2.secureserver.net";
    $port = "465";
    $username = "no-reply@wavecarrierinstitute.com";
    $password = "no-reply";
    $headers = array ('From' => $from,'To' => $to,'Subject' => $subject);

    $mime = new Mail_mime();
    $mime->setTXTBody($txt);
    
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