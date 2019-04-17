<?php

namespace Helpers;

class ViewModel implements \Contracts\RenderModel {

    private $viewName = null;
    private $variables = [];

    public function __construct($viewName,$dados=[]) {
        $this->viewName = $viewName;
        $this->variables = $dados;
        $this->variables['viewname'] = $viewName;
    }

    
    public function getTemplateName()
    {
        return $this->viewName;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function setVariables($variables)
    {
        $this->variables = $variables;

        return $this;
    }

    
    public function addVariable($name,$value)
    {
        $this->variables[$name] = $value;
        return $this;
    }


    public function setTemplateName($viewName)
    {
        $this->viewName = $viewName;

        return $this;
    }
}