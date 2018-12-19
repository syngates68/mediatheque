<?php 

namespace Mediatheque\Model;

use Model;

require_once('Model.php');

class Abonnement extends Model{

    public static function getAllAbonnements(){

        return self::_getAll('type_abonnement', ' id, nom, essai ', '', '', '', '');

    }

}