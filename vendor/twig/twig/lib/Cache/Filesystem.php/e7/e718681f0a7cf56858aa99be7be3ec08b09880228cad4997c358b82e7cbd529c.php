<?php

/* template.twig */
class __TwigTemplate_97d4aed85c1c975e28e348edd7005b5fad95e1092c198766eff35601485f888c extends Twig_Template
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
        $this->loadTemplate("inc/head.php", "template.twig", 1)->display($context);
        // line 2
        echo "
  <body>

    <div class=\"container-fluid\">
      <div class=\"row\">
        <div class=\"col-sm-2 side_nav\">
          <h1><i class=\"fas fa-video\"></i><strong>D<span class=\"violet\">o</span>ntatune</strong></h1>
          <div class=\"filters\">
            <div class=\"filter-item active\">
              <i class=\"fas fa-home\"></i><a href=\"home\">Accueil</a>
            </div>
            <div class=\"filter-item\">
              <i class=\"fas fa-search\"></i><a href=\"#\">Rechercher</a>
            </div>
            <div class=\"filter-item\">
              <i class=\"fas fa-user\"></i><a href=\"#\">Profil</a>
            </div>
          </div>
          <a role=\"button\" class=\"btn btn-success\" href=\"abonnement\"><i class=\"fas fa-video\"></i>S'abonner</a>
        </div>
        <div class=\"col-sm-12 nav_mobile\">
        <div class=\"open\">
            <div class=\"bar1\"></div>
            <div class=\"bar2\"></div>
            <div class=\"bar3\"></div>
        </div>
        <div class=\"items\">
          <h1><i class=\"fas fa-video\"></i><strong>D<span class=\"violet\">o</span>ntatune</strong></h1>
        </div>
        </div>
          <?= \$content; ?>
      </div>
    </div>

    <div class=\"side_nav_mobile\" id=\"side_nav_mobile\"> 
      <div class=\"filters_nav\">
          <a href=\"home\">Accueil</a>
          <a href=\"#\">Rechercher</a>
          <a href=\"#\">Profil</a>
          <a role=\"button\" class=\"btn btn-success\" href=\"abonnement\"><i class=\"fas fa-video\"></i>S'abonner</a>
      </div>
    </div>

    <?php require ('inc/end.php'); ?>
  </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "template.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "template.twig", "C:\\wamp64\\www\\mediatheque\\view\\template.twig");
    }
}
