<?php
 
namespace Library;

use \vendor\twig\twig\lib\Extension;
use \vendor\twig\twig\lib\Filter;

require (ROOT.DS.'vendor/autoload.php');

class ShortText extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'shortText' => new \Twig_Filter('shortText', array($this, 'shortText')),
        );
    }
 
    public function shortText($text){

        if (strlen($text) > 500){
            $text = substr($text, 0, 500);
            $position_espace = strrpos($text, " ");
            $text = substr($text, 0, $position_espace); 
            $text = $text.'[...]';
        }
        
        return $text;
    }
 
    public function getName()
    {
        return 'shortDate_extension';
    }
 
}