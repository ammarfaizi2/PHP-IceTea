<?php

namespace App\Models;

use PHPMailer;
use System\Model;
use System\Crayner\ConfigHandler\Configer;
use System\Crayner\Database\DB;

class Mailer extends Model
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function mail($u)
    {
        $mail = new PHPMailer;
        $a = Configer::smtp();
        //Tell PHPMailer to use SMTP
        $mail->isSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        #$mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = $a['host'];
        // use
        // $mail->Host = gethostbyname('smtp.gmail.com');
        // if your network does not support SMTP over IPv6

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = $a['port'];

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = $a['secure'];

        //Whether to use SMTP authentication
        $mail->SMTPAuth = $a['auth'];

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = $a['username'];

        //Password to use for SMTP authentication
        $mail->Password = $a['password'];

        //Set who the message is to be sent from
        if (isset($u['from'])) {
            $mail->setFrom($u['from'][0], $u['from'][1]);
        }

        //Set an alternative reply-to address
        if (isset($u['replyto'])) {
            $mail->addReplyTo($u['replyto'][0], $u['replyto'][1]);
        }

        //Set who the message is to be sent to
        if (isset($u['to'])) {
            $mail->addAddress($u['to'][0], $u['to'][1]);
        }

        //Set the subject line
        if (isset($u['subject'])) {
            $mail->Subject = $u['subject'];
        }

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML($u['content']);

        //Replace the plain text body with one created manually
        //$mail->AltBody = 'This is a plain-text message body';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) {
            return "Mailer Error: " . $mail->ErrorInfo;
        } else {
            return "Message sent!";
        }
    }
}
