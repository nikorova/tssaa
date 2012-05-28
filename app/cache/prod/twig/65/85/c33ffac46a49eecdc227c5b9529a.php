<?php

/* TwigBundle:Exception:trace.html.twig */
class __TwigTemplate_6585c33ffac46a49eecdc227c5b9529a extends Twig_Template
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
        if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
        if ($this->getAttribute($_trace_, "function")) {
            // line 2
            echo "    at
    <strong>
        <abbr title=\"";
            // line 4
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_trace_, "class"), "html", null, true);
            echo "\">";
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, $this->getAttribute($_trace_, "short_class"), "html", null, true);
            echo "</abbr>
        ";
            // line 5
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo twig_escape_filter($this->env, ($this->getAttribute($_trace_, "type") . $this->getAttribute($_trace_, "function")), "html", null, true);
            echo "
    </strong>
    (";
            // line 7
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->formatArgs($this->getAttribute($_trace_, "args"));
            echo ")
";
        }
        // line 9
        echo "
";
        // line 10
        if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
        if (((($this->getAttribute($_trace_, "file", array(), "any", true, true) && $this->getAttribute($_trace_, "file")) && $this->getAttribute($_trace_, "line", array(), "any", true, true)) && $this->getAttribute($_trace_, "line"))) {
            // line 11
            echo "    ";
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo (($this->getAttribute($_trace_, "function")) ? ("<br />") : (""));
            echo "
    in ";
            // line 12
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->formatFile($this->getAttribute($_trace_, "file"), $this->getAttribute($_trace_, "line"));
            echo "&nbsp;
    ";
            // line 13
            ob_start();
            // line 14
            echo "    <a href=\"#\" onclick=\"toggle('trace_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "'); switchIcons('icon_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_open', 'icon_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_close'); return false;\">
        <img class=\"toggle\" id=\"icon_";
            // line 15
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_close\" alt=\"-\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_less.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("display") : ("hidden"));
            echo "\" />
        <img class=\"toggle\" id=\"icon_";
            // line 16
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "_open\" alt=\"+\" src=\"";
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/framework/images/blue_picto_more.gif"), "html", null, true);
            echo "\" style=\"visibility: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("hidden") : ("display"));
            echo "; margin-left: -18px\" />
    </a>
    ";
            echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
            // line 19
            echo "    <div id=\"trace_";
            if (isset($context["prefix"])) { $_prefix_ = $context["prefix"]; } else { $_prefix_ = null; }
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo twig_escape_filter($this->env, (($_prefix_ . "_") . $_i_), "html", null, true);
            echo "\" style=\"display: ";
            if (isset($context["i"])) { $_i_ = $context["i"]; } else { $_i_ = null; }
            echo (((0 == $_i_)) ? ("block") : ("none"));
            echo "\" class=\"trace\">
        ";
            // line 20
            if (isset($context["trace"])) { $_trace_ = $context["trace"]; } else { $_trace_ = null; }
            echo $this->env->getExtension('code')->fileExcerpt($this->getAttribute($_trace_, "file"), $this->getAttribute($_trace_, "line"));
            echo "
    </div>
";
        }
    }

    public function getTemplateName()
    {
        return "TwigBundle:Exception:trace.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  112 => 20,  102 => 19,  89 => 16,  78 => 15,  63 => 14,  61 => 13,  56 => 12,  50 => 11,  47 => 10,  44 => 9,  32 => 5,  20 => 2,  17 => 1,  92 => 39,  86 => 6,  79 => 40,  57 => 22,  46 => 14,  37 => 8,  33 => 7,  29 => 6,  24 => 4,  19 => 1,  144 => 54,  138 => 50,  130 => 46,  124 => 42,  121 => 41,  115 => 40,  111 => 38,  108 => 37,  99 => 32,  94 => 29,  91 => 28,  88 => 27,  85 => 26,  77 => 39,  74 => 20,  71 => 19,  65 => 16,  62 => 15,  58 => 13,  54 => 11,  51 => 10,  42 => 9,  38 => 7,  35 => 7,  31 => 4,  28 => 3,);
    }
}
