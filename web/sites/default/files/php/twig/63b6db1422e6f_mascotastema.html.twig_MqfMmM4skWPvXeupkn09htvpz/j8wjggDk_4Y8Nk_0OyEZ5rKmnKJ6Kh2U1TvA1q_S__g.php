<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* modules/custom/gcaba_ba_mascotas/templates/mascotastema.html.twig */
class __TwigTemplate_a42265c61878101795a06764f04ecaf4 extends \Twig\Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
        $this->sandbox = $this->env->getExtension('\Twig\Extension\SandboxExtension');
        $this->checkSecurity();
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->attachLibrary("gcaba_ba_mascotas/gcaba_ba_mascotas"), "html", null, true);
        echo "
<div>
\tHeader
</div>

<div>
\tBOdy
\t";
        // line 8
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_0 = (($__internal_compile_1 = (($__internal_compile_2 = ($context["mascotas"] ?? null)) && is_array($__internal_compile_2) || $__internal_compile_2 instanceof ArrayAccess ? ($__internal_compile_2["mascotas"] ?? null) : null)) && is_array($__internal_compile_1) || $__internal_compile_1 instanceof ArrayAccess ? ($__internal_compile_1[0] ?? null) : null)) && is_array($__internal_compile_0) || $__internal_compile_0 instanceof ArrayAccess ? ($__internal_compile_0["name"] ?? null) : null), 8, $this->source), "html", null, true);
        echo "
\tEl total de mascotas encontradas es de
\t";
        // line 10
        echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed((($__internal_compile_3 = ($context["mascotas"] ?? null)) && is_array($__internal_compile_3) || $__internal_compile_3 instanceof ArrayAccess ? ($__internal_compile_3["total"] ?? null) : null), 10, $this->source), "html", null, true);
        echo "
\t<form class=\"ctools-auto-submit-full-form mt-2 mb-2\" action=\"\" method=\"get\" id=\"formMascotas\" accept-charset=\"UTF-8\">
        <div>
            <div class=\"filtroCiviles row\">
                <div id=\"edit-field-poblacion-ocb-value-wrapper\" class=\"col-md-3 col-sm-6 col-xs-12 estiloSelect mb-1\"><label for=\"edit-field-poblacion-ocb-value\">Tipo de Animal</label>
                    <div class=\"views-widget\">
                        <div>
                            <select class=\"form-control form-select\" id=\"tipoMascota\" name=\"tipoMascota\">
                                <option value=\"All\" selected=\"selected\">- Todos - </option>
                                <option value=\"hola\">hola</option>
                                <option value=\"Gato\">Gato</option>
                                <option value=\"Perro\">Perro</option>
\t\t\t\t\t\t\t\t <option value=\"Caniche\">Caniche</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id=\"edit-field-area-tematica-ocb-value-wrapper\" class=\"col-md-3 col-sm-6 col-xs-12 estiloSelect mb-1\"><label for=\"edit-field-area-tematica-ocb-value\">Raza</label>
                    <div class=\"views-widget\">
                        <div><select class=\"form-control form-select\" id=\"razaMascota\" name=\"razaMascota\">
                                <option value=\"All\" selected=\"selected\">- Todas - </option>
                            </select></div>
                    </div>
                </div>
                <div id=\"edit-field-barrio-ocb-value-wrapper\" class=\"col-md-3 col-sm-6 col-xs-12 estiloSelect mb-1\"><label for=\"edit-field-barrio-ocb-value\">Sexo</label>
                    <div class=\"views-widget\">
                        <div><select class=\"form-control form-select\" id=\"sexoMascota\" name=\"sexoMascota\">
                                <option value=\"All\" selected=\"selected\">- Todas - </option>
                                <option value=\"Macho\">Macho</option>
                                <option value=\"Hembra\">Hembra</option>
                            </select></div>
                    </div>
                </div>
                <button class=\"btn btn-primary form-submit\" type=\"submit\" id=\"Filtrar\" name=\"\" value=\"Filtrar\">Filtrar</button>
            </div>


        </div>
    </form>

\t<div class=\"table-responsive\">
\t\t<table id=\"tablaMascota\" class=\"table table-hover\">
\t\t\t<thead>
\t\t\t\t<tr>
\t\t\t\t\t<th scope=\"col\">#</th>
\t\t\t\t\t<th scope=\"col\">Fecha/th>
\t\t\t\t\t<th scope=\"col\">Tipo de Caso</th>
\t\t\t\t\t<th scope=\"col\">Animal</th>
\t\t\t\t\t<th scope=\"col\">Raza</th>
\t\t\t\t\t<th scope=\"col\">Edad</th>
\t\t\t\t\t<th scope=\"col\">Sexo</th>
\t\t\t\t\t<th scope=\"col\">Tamaño</th>
\t\t\t\t\t<th scope=\"col\">Observaciones</th>
\t\t\t\t\t<th scope=\"col\">Imagen</th>
\t\t\t\t\t<th scope=\"col\">Acciones</th>
\t\t\t\t</tr>
\t\t\t</thead>
\t\t\t<tbody>
\t\t\t\t";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((($__internal_compile_4 = ($context["mascotas"] ?? null)) && is_array($__internal_compile_4) || $__internal_compile_4 instanceof ArrayAccess ? ($__internal_compile_4["mascotas"] ?? null) : null));
        foreach ($context['_seq'] as $context["_key"] => $context["mascota"]) {
            // line 69
            echo "\t\t\t\t\t<tr>
\t\t\t\t\t\t<td>";
            // line 70
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "IdDAtos", [], "any", false, false, true, 70), 70, $this->source));
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 71
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "FechaInicio", [], "any", false, false, true, 71), 71, $this->source));
            echo "</td>
                        <td>";
            // line 72
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "TipoDeCaso", [], "any", false, false, true, 72), 72, $this->source));
            echo "</td>
                        <td>";
            // line 73
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "TipoAnimal", [], "any", false, false, true, 73), 73, $this->source));
            echo "</td>
                        <td>";
            // line 74
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "RazaAnimal", [], "any", false, false, true, 74), 74, $this->source));
            echo "</td>
\t\t\t\t\t\t<td>";
            // line 75
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "Edad", [], "any", false, false, true, 75), 75, $this->source));
            echo "</td>
                        <td>";
            // line 76
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "SexoAnimal", [], "any", false, false, true, 76), 76, $this->source));
            echo "</td>
                        <td>";
            // line 77
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "Tamano", [], "any", false, false, true, 77), 77, $this->source));
            echo "</td>
                        <td>";
            // line 78
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "Observaciones", [], "any", false, false, true, 78), 78, $this->source));
            echo "</td>
                        <td><img src=";
            // line 79
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "Imagen", [], "any", false, false, true, 79), 79, $this->source));
            echo " alt=";
            echo $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->sandbox->ensureToStringAllowed(twig_get_attribute($this->env, $this->source, $context["mascota"], "TipoAnimal", [], "any", false, false, true, 79), 79, $this->source), "html", null, true);
            echo " /> </td>
                        <td><a class=\"btn btn-primary\" href=\"https://gestioncolaborativa-hml.gcba.gob.ar/confirmacion/1667240870444\">Contactar</a></td>
\t\t\t\t\t</tr>
\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['mascota'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 82
        echo " 
\t\t\t</tbody>
\t\t</table>
\t\t<nav aria-label=\"Navegador de paginas\">
\t\t\t<ul class=\"pagination\" id=\"paginador\">

\t\t\t\t<li class=\"page-item\">
\t\t\t\t\t<a class=\"page-link\" href=\"#\">Anterior</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"page-item\">
\t\t\t\t\t<a class=\"page-link\" href=\"#\">1</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"page-item\">
\t\t\t\t\t<a class=\"page-link\" href=\"#\">2</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"page-item\">
\t\t\t\t\t<a class=\"page-link\" href=\"#\">3</a>
\t\t\t\t</li>
\t\t\t\t<li class=\"page-item\">
\t\t\t\t\t<a class=\"page-link\" href=\"#\">Siguiente</a>
\t\t\t\t</li>
\t\t\t</ul>
\t\t</nav>
\t</div>


</div>

<div>
\tFOoter
</div>
";
    }

    public function getTemplateName()
    {
        return "modules/custom/gcaba_ba_mascotas/templates/mascotastema.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 82,  158 => 79,  154 => 78,  150 => 77,  146 => 76,  142 => 75,  138 => 74,  134 => 73,  130 => 72,  126 => 71,  122 => 70,  119 => 69,  115 => 68,  54 => 10,  49 => 8,  39 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "modules/custom/gcaba_ba_mascotas/templates/mascotastema.html.twig", "/home/phauno/pablodrupal/web/modules/custom/gcaba_ba_mascotas/templates/mascotastema.html.twig");
    }
    
    public function checkSecurity()
    {
        static $tags = array("for" => 68);
        static $filters = array("escape" => 1, "e" => 70);
        static $functions = array("attach_library" => 1);

        try {
            $this->sandbox->checkSecurity(
                ['for'],
                ['escape', 'e'],
                ['attach_library']
            );
        } catch (SecurityError $e) {
            $e->setSourceContext($this->source);

            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            }

            throw $e;
        }

    }
}
