<?php 

namespace Mediatheque\Model;

use Model;

require_once('Model.php');

class Video extends Model{

    public static function getAllVideos(){

        return self::_getAll('video v', ' v.titre, v.id_theme, v.gratuite, v.lien, v.prix, v.date_ajout, t.nom as theme, t.couleur ', ' left join theme t on v.id_theme = t.id ', '', '', ' ORDER BY v.gratuite DESC');

    }

}