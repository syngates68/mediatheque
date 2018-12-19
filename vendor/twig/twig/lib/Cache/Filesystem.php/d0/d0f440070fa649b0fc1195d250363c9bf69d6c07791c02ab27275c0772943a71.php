<?php

/* inc/head.php */
class __TwigTemplate_92ce89a698dba58e6c662ef85149cc48c90bb4e8e75095335dd10907851b27a7 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!doctype html>
<html lang=\"fr\">
  <head>
    <meta charset=\"utf-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <link rel=\"icon\" href=\"public/images/favicon.png\">

    <title> Dontatune - <?= \$title; ?> </title>

    <!-- Bootstrap core CSS -->
    <link href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css\" rel=\"stylesheet\">

    <!-- Custom styles for this template -->
    <link href=\"public/css/style.css\" rel=\"stylesheet\">

    <link href=\"https://fonts.googleapis.com/css?family=Roboto\" rel=\"stylesheet\"> 

    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\" integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" crossorigin=\"anonymous\">

  </head>";
    }

    public function getTemplateName()
    {
        return "inc/head.php";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "inc/head.php", "C:\\wamp64\\www\\mediatheque\\view\\inc\\head.php");
    }
}
