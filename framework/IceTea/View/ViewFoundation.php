<?php

namespace IceTea\View;

use InvalidArgumentException;

final class ViewFoundation
{
    /**
     *
     */
    private $variable;

    private $view;


    public function __construct($view, $variable)
    {
        $this->name = $view;
        $this->variable = $variable;
    }

    public function getViewFile()
    {
        if ($file = $this->findViewFile()) {
            return file_get_contents($file);
        } else {
            throw new InvalidArgumentException("View [$this->name] not found.");
        }
    }

    public function getViewFileName()
    {
        return $this->view;
    }

    private function findViewFile()
    {
        
    }

    public function getVariables()
    {
        return $this->variable;
    }
}
