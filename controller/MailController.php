<?php

namespace Controller;

use PDO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

define('MAIL_HOST', 'smtp.orange.fr');
define('MAIL_SMTPAUTH', false);
define('MAIL_SMTPSECURE', 'ssl');
define('MAIL_PORT', 465);
define('SMTP_DEBUG', 1);

class MailController extends Controller
{
    public $controller_name = 'mail';

    public static function getMail(){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP_DEBUG;
        $mail->Host = MAIL_HOST;
        $mail->SMTPAuth = MAIL_SMTPAUTH;                       
        $mail->SMTPSecure = MAIL_SMTPSECURE;                            
        $mail->Port = MAIL_PORT;

        $mail->From = "quentin.schifferle@gmail.com";
        $mail->FromName = "DONTATUNE";
        return $mail;
    }

    public static function send($mail){
        $mail->send();
    }

    public static function confirm_inscription($user, $code){
        $msg = '';
        $mail = self::getMail();

        try{
            $mail->addAddress($user->get_mail(),"");

            $c = new MailController();
            $c->set('prenom', $user->get_prenom());
            $c->set('code', $code);
            $c->render('confirm_inscription');

            $mail->isHTML(true);
            $mail->Subject = utf8_decode("DONTATUNE - Inscription à la plateforme");
            $mail->Body = utf8_decode($c->getResponse()->getBody());
            $mail->AltBody = "";
            self::send($mail);
            $msg = 'Message envoyé';
        }        
        catch(Exception $e){
            $msg = 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    
    public static function forgotten_password($user, $code){
        $msg = '';
        $mail = self::getMail();

        try{
            $mail->addAddress($user->get_mail(),"");

            $c = new MailController();
            $c->set('prenom', $user->get_prenom());
            $c->set('code', $code);
            $c->render('forgotten_password');

            $mail->isHTML(true);
            $mail->Subject = utf8_decode("DONTATUNE - Mot de passe oublié");
            $mail->Body = utf8_decode($c->getResponse()->getBody());
            $mail->AltBody = "";
            self::send($mail);
            $msg = 'Message envoyé';
        }        
        catch(Exception $e){
            $msg = 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}