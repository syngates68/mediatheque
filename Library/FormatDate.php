<?php
 
namespace Library;

use \vendor\twig\twig\lib\Extension;
use \vendor\twig\twig\lib\Filter;

require (ROOT.DS.'vendor/autoload.php');

class FormatDate extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'formatDate' => new \Twig_Filter('formatDate', array($this, 'formatDate')),
        );
    }
 
    public function formatDate($datetime)
    {
        setlocale(LC_TIME, 'fra_fra');
        $now = time();
        $created = strtotime($datetime);
        // La différence est en seconde
        //echo $now;
        $diff = $now-$created;
        $m = ($diff)/(60); // on obtient des minutes
        $h = ($diff)/(60*60); // ici des heures
        $j = ($diff)/(60*60*24); // jours
        $s = ($diff)/(60*60*24*7); // semaines
        $mo = ($diff)/(60*60*24*7*4); //mois
        $a = ($diff)/(60*60*24*7*4*12); // années
        if ($diff < 60) { // "à l'instant"
            return 'A l\'instant';
        }
        elseif ($m < 60) { // "il y a x minutes"
            $minute = (floor($m) == 1) ? 'minute' : 'minutes';
            return 'Il y a '.floor($m).' '.$minute;
        }
        elseif ($h < 24) { // " il y a x heures"
            $heure = (floor($h) <= 1) ? 'heure' : 'heures';
            $dateFormated = 'Il y a '.floor($h).' '.$heure;
            return $dateFormated;
        }
        elseif ($j < 7) { // " il y a x jours"
            //$jour = (floor($j) <= 1) ? 'jour' : 'jours';
            if (floor($j) <= 1){
                $dateFormated = 'Hier';
            }
            else{
                $dateFormated = 'Il y a '.floor($j).' jours';
            }
            return $dateFormated;
        }
        elseif ($s < 5) { // " il y a x semaines"
            $semaine = (floor($s) <= 1) ? 'semaine' : 'semaines';
            $dateFormated = 'Il y a '.floor($s).' '.$semaine;
            return $dateFormated;
        }
        elseif ($mo < 12){
            $dateFormated = 'Il y a '.floor($mo).' mois';
            return $dateFormated;
        }
        else{
            $annees = (floor($a) <= 1) ? 'an' : 'ans';
            $dateFormated = 'Il y a '.floor($a).' '.$annees;
            return $dateFormated;
        }
    }
 
    public function getName()
    {
        return 'formatDate_extension';
    }
 
}