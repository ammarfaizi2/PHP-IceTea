<?php

namespace System\Crayner\Input;

use System\Crayner\Input\InputUtilities;
use System\Crayner\Contracts\Input\PostGate;

/**
 * @author Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class InputHandler implements PostGate
{
    /**
     * @var array
     */
    private $purePost;

    /**
     * @var string
     */
    private $phpInput;

    /**
     * @var string
     */
    private $toString;

    /**
     *
     * Constructor.
     *
     *
     */
    public function __construct()
    {
        $this->purePost = is_array($_POST) ? $_POST : array();
        $this->phpInput = file_get_contents("php://input");
    }

    /**
     * @return InputHandler
     */
    public function phpInput()
    {
        $this->toString = $this->phpInput;
        return new InputUtilities($this->toString);
    }

    /**
     * @param  string	$key
     * @return InputHandler
     */
    public function post(string $key)
    {
        $this->toString = isset($this->purePost[$key]) ? $this->purePost[$key] : "";
        return new InputUtilities($this->toString);
    }

   
    public function __toString()
    {
        return $this->toString;
    }
}
