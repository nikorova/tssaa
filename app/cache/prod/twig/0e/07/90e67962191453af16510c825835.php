<?php

/* TwigBundle:Exception:exception.css.twig */
class __TwigTemplate_0e0790e67962191453af16510c825835 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "/*
";
        // line 2
        if (isset($context["exception"])) { $_exception_ = $context["exception"]; } else { $_exception_ = null; }
        $this->env->loadTemplate("TwigBundle:Exception:exception.txt.twig")->display(array_merge($context, array("exception" => $_exception_)));
        // line 3
        echo "*/
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:exception.css.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  22 => 4,  27 => 3,  43 => 7,  25 => 3,  34 => 6,  30 => 4,  55 => 9,  48 => 7,  45 => 6,  36 => 5,  23 => 3,  112 => 20,  102 => 19,  89 => 16,  78 => 15,  63 => 14,  61 => 13,  56 => 12,  50 => 11,  47 => 8,  44 => 7,  32 => 5,  20 => 2,  17 => 1,  92 => 39,  86 => 6,  79 => 40,  57 => 22,  46 => 14,  37 => 7,  33 => 4,  29 => 6,  24 => 4,  19 => 1,  144 => 54,  138 => 50,  130 => 46,  124 => 42,  121 => 41,  115 => 40,  111 => 38,  108 => 37,  99 => 32,  94 => 29,  91 => 28,  88 => 27,  85 => 26,  77 => 39,  74 => 20,  71 => 19,  65 => 16,  62 => 15,  58 => 13,  54 => 11,  51 => 10,  42 => 9,  38 => 7,  35 => 7,  31 => 4,  28 => 3,);
    }
}
