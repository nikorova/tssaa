<?php

/* AcmeHelloBundle:Hello:index2.html.twig */
class __TwigTemplate_44b8f5a9ae882ff5cc72d037f0f3e383 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("::base.html.twig");

        $this->blocks = array(
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "::base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 4
        echo "<style type\"text/css\">
\tbody { margin: 0px; }
\t#background {
\t\tbackground-color: lightblue;
\t\tposition: fixed;
\t\tpadding-top: 1px;
\t\tmargin: 0px 0px;
\t\theight: 100%;
\t\twidth: 100%;
\t}
\t.container {
\t\twidth: 800px;
\t\theight: 100%;
\t\tbackground-color: grey;
\t\tmargin: 20px auto;
\t\tpadding: 20px;
\t}

\t.content {
\t\tmargin: 20px auto;
\t}\t
</style>
";
    }

    // line 28
    public function block_body($context, array $blocks = array())
    {
        // line 29
        echo "<div id=\"background\">
<div class=\"container\">
\t\t<div class=\"content\">
\t\t\t<h2> Repeat after me, ";
        // line 32
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "</h2>

\t\t\t<p>I, [recruit's name], do solemnly swear by [recruit's deity of choice] to uphold the Laws and Ordinances of the city of Ankh-Morpork, serve the public trust, and defend the subjects of His/Her [delete whichever is inappropriate] Majesty [name of reigning monarch] without fear, favor, or thought of personal safety; to pursue evil-doers and protect the innocent, laying down my life if necessary in the cause of said duty, so help me [aforesaid deity]. Gods Save the King/Queen [delete which is inappropriate]</p>
\t</div>
\t<div class=\"content\">
\t\t\t<h2> No no, say <em>";
        // line 37
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "</em>, ";
        echo twig_escape_filter($this->env, $this->getContext($context, "name"), "html", null, true);
        echo "</h2>

\t\t\t<p>I, [recruit's name], do solemnly swear by [recruit's deity of choice] to uphold the Laws and Ordinances of the city of Ankh-Morpork, serve the public trust, and defend the subjects of His/Her [delete whichever is inappropriate] Majesty [name of reigning monarch] without fear, favor, or thought of personal safety; to pursue evil-doers and protect the innocent, laying down my life if necessary in the cause of said duty, so help me [aforesaid deity]. Gods Save the King/Queen [delete which is inappropriate]</p>
\t</div>
\t<div class=\"content\">
\t\t<h2> Ah well. I tried. </h2>
\t</div>
</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "AcmeHelloBundle:Hello:index2.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  72 => 37,  64 => 32,  59 => 29,  56 => 28,  30 => 4,  27 => 3,);
    }
}
