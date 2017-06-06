<?php

namespace System\Crayner\Input;

use System\Crayner\Contracts\Input\InputBinding;
use System\Crayner\WhiteHat\Encryption\Teacrypt\Teacrypt;

/**
 * @author Ammar Faizi	<ammarfaizi2@gmail.com>
 */

class InputUtilities implements InputBinding
{
	/**
	 * @var string
	 */
	private $toString;

	/**
	 *
	 * Constructor.
	 *
	 *
	 *
	 */
	public function __construct($toString)
	{
		$this->toString = $toString;
	}

  	/**
     * @param	int	$cat
     * @return  InputUtilities
     */
    public function escape(int $cat = 0)
    {
        if ($cat === 5) {
            $this->toString = addcslashes($this->toString, "A..z");
        } else {
            $this->toString = addslashes($this->toString);
        }
        return $this;
    }

    /**
     * @param  string	$key
     * @return InputUtilities
     */
    public function encrypt(string $key = "icetea")
    {
        $this->toString = empty($this->toString) ? '' : Teacrypt::encrypt($this->toString, $key);
        return $this;
    }

    /**
     * @param  string	$key
     * @return InputUtilities
     */
    public function decrypt(string $key)
    {
    	$this->toString = empty($this->toString) ? '' : Teacrypt::decrypt($this->toString, $key);
        return $this;
    }

    public function __toString()
    {
    	return $this->toString;
    }
}