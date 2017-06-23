<?php

/**
 * Created by PhpStorm.
 * User: crosscomp
 * Date: 06.12.2016
 * Time: 11:10
 */
class Mail
{
    public static function send(array $to, $subject, $body, $from = '', array $attachment = [], $isHTML = true)
    {
//        require 'PHPMailerAutoload.php';
        $mail = new PHPMailer;

//        $mail->SMTPDebug = 2; // Enable verbose debug output

        $mail->isSMTP();                                // Set mailer to use SMTP
        $mail->Host = config('mail.host');              // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                         // Enable SMTP authentication
        $mail->Username = config('mail.username');      // SMTP username
        $mail->Password = config('mail.password');      // SMTP password
        $mail->SMTPSecure = 'tls';                      // Enable TLS encryption, `ssl` also accepted
//        $mail->SMTPSecure = 'ssl';                      // Enable TLS encryption, `ssl` also accepted
        $mail->Port = config('mail.smtp_port');         // TCP port to connect to
//        $mail->Port = 587;                              // TCP port to connect to

        if(! empty($from))
        {
            $mail->setFrom(config('mail.from'), 'Banants Apply Page');
        }else{
            $mail->setFrom($from, 'Banants Apply Page');
        }

        foreach ($to as $item) {
            $mail->addAddress($item); // Add a recipient
        }

//        $mail->addReplyTo('info@example.com', 'Information');
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        if (! empty($attachment))
        {
            foreach ($attachment as $item) {
                $mail->addAttachment($item); // Add a recipient
            }
        }

        $mail->isHTML($isHTML); // Set email format to HTML

        $mail->Subject = $subject;
        $mail->Body    = $body;
//        $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if(!$mail->send()) {
            Message::instance()->warning('Message could not be sent.');
//            Message::instance()->warning('Mailer Error: ' . $mail->ErrorInfo);
        } else {
            Message::instance()->success('Message has been sent');
        }
    }
}