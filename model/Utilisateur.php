<?php 

namespace Model;

use PDO;

/**
 * Class model : Utilisateur
 * @author Quentin SCHIFFERLE
 * @version 1
 * Représente un utilisateur de la plateforme
**/
class Utilisateur extends Model{

    private $_id;
    private $_nom;
    private $_prenom;
    private $_pseudo;
    private $_date_creation;
	private $_mail;
	private $_pic;
	private $_pass;
	private $_confirm_key;
	private $_confirm;
    
    public function get_id(){
		return $this->_id;
	}

	public function set_id($_id){
		$this->_id = $_id;
	}

	public function get_nom(){
		return $this->_nom;
	}

	public function set_nom($_nom){
		$this->_nom = $_nom;
	}

	public function get_prenom(){
		return $this->_prenom;
	}

	public function set_prenom($_prenom){
		$this->_prenom = $_prenom;
	}

	public function get_pseudo(){
		return $this->_pseudo;
	}

	public function set_pseudo($_pseudo){
		$this->_pseudo = $_pseudo;
	}

	public function get_date_creation(){
		return $this->_date_creation;
	}

	public function set_date_creation($_date_creation){
		$this->_date_creation = $_date_creation;
	}

	public function get_mail(){
		return $this->_mail;
	}

	public function set_mail($_mail){
		$this->_mail = $_mail;
	}

	public function get_pic(){
		return $this->_pic;
	}

	public function set_pic($_pic){
		$this->_pic = $_pic;
	}

	public function get_pass(){
		return $this->_pass;
	}

	public function set_pass($_pass){
		$this->_pass = $_pass;
	}
	
	public function get_confirm_key(){
		return $this->_confirm_key;
	}

	public function set_confirm_key($_confirm_key){
		$this->_confirm_key = $_confirm_key;
	}
	
	public function get_confirm(){
		return $this->_confirm;
	}

	public function set_confirm($_confirm){
		$this->_confirm = $_confirm;
	}

    // Requêtes BDD
    
    public static function getUserByMail($mail, $pass){
        return self::_getOne('utilisateur u ', ' * ', '', 'u.mail = :mail AND u.pass = :pass', [
			['key' => ':mail', 'value' => $mail, 'type' => PDO::PARAM_STR],
			['key' => ':pass', 'value' => $pass, 'type' => PDO::PARAM_STR],
		]);
	}

	    
    public static function getUserByPseudo($pseudo, $pass){
        return self::_getOne('utilisateur u ', ' * ', '', 'u.pseudo = :pseudo AND u.pass = :pass', [
			['key' => ':pseudo', 'value' => $pseudo, 'type' => PDO::PARAM_STR],
			['key' => ':pass',   'value' => $pass,   'type' => PDO::PARAM_STR],
		]);
	}

	public static function getUserById($id){
		return self::_getOne('utilisateur u ', ' u.id, u.nom, u.prenom, u.pseudo, u.date_creation, u.mail, u.pic, u.pass, u.confirm_key ', '', 'id = :id', [
			['key' => ':id', 'value' => $id, 'type' => PDO::PARAM_INT],
        ]);
	}

	public static function getUserExist($pseudo){
		return self::_getOne('utilisateur u ', ' * ', '', 'u.pseudo = :pseudo', [
			['key' => ':pseudo', 'value' => $pseudo, 'type' => PDO::PARAM_STR],
		]);
	}

	public static function getMailExist($mail){
		return self::_getOne('utilisateur u ', ' * ', '', 'u.mail = :mail', [
			['key' => ':mail', 'value' => $mail, 'type' => PDO::PARAM_STR],
		]);
	}

	public static function getUserConfirm($id_user){
		return self::_getOne('utilisateur u ', ' * ', '', 'u.id = :id AND u.confirm = 1', [
			['key' => ':id', 'value' => $id_user, 'type' => PDO::PARAM_INT],
		]);
	}

	public function utilisateur_create(){
		return self::_create('utilisateur', [
			['key' => 'nom', 'value' => $this->get_nom(), 'type' => PDO::PARAM_STR],
			['key' => 'prenom', 'value' => $this->get_prenom(), 'type' => PDO::PARAM_STR],
			['key' => 'pseudo', 'value' => $this->get_pseudo(), 'type' => PDO::PARAM_STR],
			['key' => 'mail', 'value' => $this->get_mail(), 'type' => PDO::PARAM_STR],
			['key' => 'pass', 'value' => $this->get_pass(), 'type' => PDO::PARAM_STR],
			['key' => 'confirm_key', 'value' => $this->get_confirm_key(), 'type' => PDO::PARAM_INT]
		]);

		$this->set_id($u['id']);

        return ($u['count'] > 0) ? $this : false;
	}

	public static function updateMail($mail, $id_user){
		return self::_update('utilisateur', 'mail = :mail', 'id = :id_user', [
			'mail' => $mail,
			'id_user' => $id_user
		]);
	}

	public static function updatePassword($password, $id_user){
		return self::_update('utilisateur', 'pass = :password', 'id = :id_user', [
			'password' => $password,
			'id_user' => $id_user
		]);
	}

	public static function updateConfirm($id_user){
		return self::_update('utilisateur', 'confirm = 1', 'id = :id', [
			'id' => $id_user
		]);
	}

	public static function updateAvatar($photo, $id_user){
		return self::_update('utilisateur', 'pic = :photo', 'id = :id_user', [
			'photo' => $photo,
			'id_user' => $id_user
		]);
	}

	public static function deleteUser($id_user){
		return self::_delete('utilisateur u', 'u, a, ac, c, p, n, x', ' LEFT JOIN abonnement a ON u.id = a.id_utilisateur LEFT JOIN achat ac ON u.id = ac.id_utilisateur LEFT JOIN commentaire c ON u.id = c.id_utilisateur LEFT JOIN paiements p ON u.id = p.payer_id LEFT JOIN notes n ON u.id = n.id_utilisateur LEFT JOIN carte x ON u.id = x.id_user', 'u.id = :id_user', [
			['key' => 'id_user', 'value' => $id_user, 'type' => PDO::PARAM_INT]
		]);
	}
	
	/***************************************/
	public static function buildModel(array $line){
		$u = new Utilisateur([
			"id" 			=> $line['id'],
			"nom" 			=> $line['nom'],
			"prenom" 		=> $line['prenom'],
			"pseudo"        => $line['pseudo'],
			"date_creation" => $line['date_creation'],
			"mail" 			=> $line['mail'],
			"pic" 			=> $line['pic'],
			"pass" 			=> $line['pass'],
			"confirm_key"   => $line['confirm_key']
		]);
		return $u;
	}

}