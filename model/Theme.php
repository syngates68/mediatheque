<?php 

namespace Mediatheque\Model;

use Model;

require_once('Model.php');

class Theme extends Model{

    public static function getAllThemes(){

        return self::_getAll('theme', ' id, nom, couleur ', '', '', '', '');

    }

}