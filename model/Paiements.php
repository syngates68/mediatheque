<?php 

namespace Model;

use PDO;

/**
 * Class model : Paiements
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente les paiements réalisés avec PayPal
**/
class Paiements extends Model{

    private $_id;
    private $_payment_id;
    private $_payment_status;
    private $_payment_amount;
    private $_payment_currency;
    private $_payment_date;
    private $_payer_email;
    private $_payer_id;

    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_payment_id(){
		return $this->_payment_id;
	}

	public function set_payment_id($_payment_id){
		$this->_payment_id = $_payment_id;
	}

	public function get_payment_status(){
		return $this->_payment_status;
	}

	public function set_payment_status($_payment_status){
		$this->_payment_status = $_payment_status;
	}

	public function get_payment_amount(){
		return $this->_payment_amount;
	}

	public function set_payment_amount($_payment_amount){
		$this->_payment_amount = $_payment_amount;
	}

	public function get_payment_currency(){
		return $this->_payment_currency;
	}

	public function set_payment_currency($_payment_currency){
		$this->_payment_currency = $_payment_currency;
	}

	public function get_payment_date(){
		return $this->_payment_date;
	}

	public function set_payment_date($_payment_date){
		$this->_payment_date = $_payment_date;
	}

	public function get_payer_email(){
		return $this->_payer_email;
	}

	public function set_payer_email($_payer_email){
		$this->_payer_email = $_payer_email;
    }
    
    public function get_payer_id(){
		return $this->_payer_id;
	}

	public function set_payer_id($_payer_id){
		$this->_payer_id = $_payer_id;
	}
	   
	// Requêtes BDD

    public static function getAllByUser($id_user){

        return self::_getInner('paiements p', ' p.id, p.payment_id, p.payment_status, p.payment_amount, p.payment_currency, p.payment_date, p.payer_email, p.payer_id ', ' left join utilisateur u on p.payer_id = u.id ', 'p.payer_id = :id', '', ' ORDER BY p.payment_date DESC', [
            ['key' => ':id', 'value' => $id_user, 'type' => PDO::PARAM_INT],
        ]);

	}

	public function paiement_create(){
		return self::_create('paiements', [
			['key' => 'payment_id', 'value' => $this->get_payment_id(), 'type' => PDO::PARAM_STR],
			['key' => 'payment_status', 'value' => $this->get_payment_status(), 'type' => PDO::PARAM_STR],
			['key' => 'payment_amount', 'value' => $this->get_payment_amount(), 'type' => PDO::PARAM_STR],
			['key' => 'payment_currency', 'value' => $this->get_payment_currency(), 'type' => PDO::PARAM_STR],
			['key' => 'payer_email', 'value' => $this->get_payer_email(), 'type' => PDO::PARAM_STR],
			['key' => 'payer_id', 'value' => $this->get_payer_id(), 'type' => PDO::PARAM_INT]
		]);

		$this->set_id($p['id']);

        return ($p['count'] > 0) ? $this : false;
	}

	/***************************************/

	public static function buildModel(array $line){
		$p = new Paiements([
			"id" 			   => $line['id'],
			"payment_id"       => $line['payment_id'],
			"payment_status"   => $line['payment_status'],
			"payment_amount"   => $line['payment_amount'],
            "payment_currency" => $line['payment_currency'],
            "payment_date"     => $line['payment_date'],
            "payer_email" 	   => $line['payer_email'],
            "payer_id" 		   => $line['payer_id']
		]);
        return $p;
	}
    
    public static function buildInner(array $line){
		$tab = array(
			"id" 			   => $line['id'],
			"payment_id" 	   => $line['payment_id'],
			"payment_status"   => $line['payment_status'],
			"payment_amount"   => $line['payment_amount'],
            "payment_currency" => $line['payment_currency'],
            "payment_date" 	   => $line['payment_date'],
            "payer_email" 	   => $line['payer_email'],
            "payer_id" 		   => $line['payer_id']
		);
		return $tab;
	}

}