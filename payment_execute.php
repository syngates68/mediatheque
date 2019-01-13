<?php

include ('vendor/PaypalPayment.php');

$bdd = new PDO('mysql:host=localhost;dbname=mediatheque;charset=utf8', 'root', '');

$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];

$ref = isset($_GET['ref']) ? $_GET['ref'] : '';
$user = isset($_GET['user']) ? $_GET['user'] : '';

if (!empty($_POST['paymentID']) AND !empty($_POST['payerID'])) {
    $paymentID = htmlspecialchars($_POST['paymentID']);
    $payerID = htmlspecialchars($_POST['payerID']);

    $payment = new Vendor\PaypalPayment;
    $payment->setClientID('AS-5mDifqkwXocxDPyY43-McUUu61r1bBXJguRsTe4kLMYi825nJqpleIe8gX0a3k2F8Xoch3oNDjIEx');
    $payment->setSecret('EH1lOo_fngYMK1R4Abg_oRFTtr6HneiaWMp1Cv-U-44tx8dnKDOLq3rPrLT0X0eOBN46NEoy7SRpQUsg');
    //$payment->generateAccessToken();
    //$payment->getAccessToken();

    $p = $bdd->prepare('SELECT * FROM paiements WHERE payment_id = :payment_id');
    $p->execute(array('payment_id' => $paymentID));
    $p = $p->fetch();

    if ($p){
        $paypal_response = $payment->executePayment($paymentID, $payerID);
        $paypal_response = json_decode($paypal_response);

        $update_payment = $bdd->prepare('UPDATE paiements SET payment_status = ?, payer_email = ? WHERE payment_id = ?');
        $update_payment->execute(array($paypal_response->state, $paypal_response->payer->payer_info->email, $paymentID));
        
        $achat = $bdd->prepare('INSERT INTO achat (id_utilisateur, id_video) VALUES (:id_utilisateur, :id_video)');
        $achat->execute(array('id_utilisateur' => $user, 'id_video' => $ref));

        if ($paypal_response->state == "approved") {
            $success = 1;
            $msg = '';
        }
        else {
            $msg = "Une erreur est survenue durant l'approbation de votre paiement. Merci de réessayer ultérieurement ou contacter un administrateur du site.";
        }
    }
    else {
        $msg = "Votre paiement n'a pas été trouvé dans notre base de données. Merci de réessayer ultérieurement ou contacter un administrateur du site. (Votre compte PayPal n'a pas été débité)";
    }
}

echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
