<?php

/* TwigBundle:Exception:error.txt.twig */
class __TwigTemplate_a82fd8582480b1a9e97f5159a8bfaf46 extends Twig_Template
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
        echo "Oops! An Error Occurred
=======================

The server returned a \"";
        // line 4
        if (isset($context["status_code"])) { $_status_code_ = $context["status_code"]; } else { $_status_code_ = null; }
        echo twig_escape_filter($this->env, $_status_code_, "html", null, true);
        echo " ";
        if (isset($context["status_text"])) { $_status_text_ = $context["status_text"]; } else { $_status_text_ = null; }
        echo twig_escape_filter($this->env, $_status_text_, "html", null, true);
        echo "\".

Please e-mail us at [email] and let us know what you were doing when this
error occurred. We will fix it as soon as possible. Sorry for any
inconvenience caused.
";
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:error.txt.twig";
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
