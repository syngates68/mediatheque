<?php

include ('vendor/PaypalPayment.php');

$bdd = new PDO('mysql:host=localhost;dbname=mediatheque;charset=utf8', 'root', '');

$success = 0;
$msg = "Une erreur est survenue, merci de bien vouloir réessayer ultérieurement...";
$paypal_response = [];

$user = isset($_GET['user']) ? $_GET['user'] : '';

if (isset($_GET['ref'])){

    $ref = htmlspecialchars($_GET['ref']);

    $video = $bdd->prepare('SELECT * FROM video WHERE id = :id');
    $video->execute(array('id' => $ref));

    $video = $video->fetch(PDO::FETCH_ASSOC);

    if ($video){

        $sku = '0000'.$video['id'].strtoupper(substr($video['titre'], 0, 3));
        $sku = str_replace(' ', 0, $sku);

        $payment = new Vendor\PaypalPayment;
        $payment->setClientID('AS-5mDifqkwXocxDPyY43-McUUu61r1bBXJguRsTe4kLMYi825nJqpleIe8gX0a3k2F8Xoch3oNDjIEx');
        $payment->setSecret('EH1lOo_fngYMK1R4Abg_oRFTtr6HneiaWMp1Cv-U-44tx8dnKDOLq3rPrLT0X0eOBN46NEoy7SRpQUsg');
        //$payment->generateAccessToken();
        //$payment->getAccessToken();
        
        $payment_data = [
            "intent" => "sale",
            "redirect_urls" => [
                "return_url" => "http://localhost/mediatheque/payment.php",
                "cancel_url" => "http://localhost/mediatheque/payment.php"
            ],
            "payer" => [
                "payment_method" => "paypal"
            ],
            "transactions" => [
                [
                    "amount" => [
                        "total" => $video['prix'],
                        "currency" => "EUR"
                    ],
                    "item_list" => [
                        "items" => [
                            [
                                "quantity" => "1",
                                "sku" => $sku,
                                "name" => $video['titre'],
                                "price" => $video['prix'],
                                "currency" => "EUR"
                            ]
                        ]
                    ],
                    "description" => "Paiement de la vidéo ".$video['titre']." sur le site Dontatune"
                ]
            ]
        ];
        
        $paypal_response = $payment->createPayment($payment_data);
        $paypal_response = json_decode($paypal_response);
        
        if (!empty($paypal_response->id)){
            $i = $bdd->prepare("INSERT INTO paiements (payment_id, payment_status, payment_amount, payment_currency, payment_date, payer_email, payer_id) VALUES (:payment_id, :payment_status, :payment_amount, :payment_currency, NOW(), '', :payer_id)");
            $v = $i->execute(array(
                'payment_id' => $paypal_response->id,
                'payment_status' => $paypal_response->state,
                'payment_amount' => $paypal_response->transactions[0]->amount->total,
                'payment_currency' => $paypal_response->transactions[0]->amount->currency,
                'payer_id' => $user
            ));
        
            if ($v){
                $success = 1;
                $msg = '';
            }
        }
        else{
            $msg = 'Une erreur est survenue durant la communication avec les serveurs de PayPal';
        }
    }

    else{
        $msg = 'Cette vidéo ne semble pas être disponible actuellement';
    }
}
echo json_encode(["success" => $success, "msg" => $msg, "paypal_response" => $paypal_response]);
