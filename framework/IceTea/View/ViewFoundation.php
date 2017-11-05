<?php

namespace IceTea\View;

final class ViewFoundation
{
    /**
     *
     */
    private $variable;

    private $view;


    public function __construct($view, $variable)
    {
        $this->view = basepath("app/Views/".$view.".tea.php");
        $this->variable = $variable;
    }

    public function getViewFile()
    {
        return file_get_contents($this->view);
    }

    public function getViewFileName()
    {
        return $this->view;
    }

    public function getVariables()
    {
        return $this->variable;
    }
}
