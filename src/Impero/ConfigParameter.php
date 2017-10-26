<?php
/**
 * Impero: Command manager
 * Copyright (c) NewClass (http://newclass.pl)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the file LICENSE
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) NewClass (http://newclass.pl)
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace Impero;

/**
 * Class ConfigParameter
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ConfigParameter
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var bool
     */
    private $required;
    /**
     * @var mixed
     */
    private $default;

    /**
     * ConfigAttribute constructor.
     * @param string $name
     * @param mixed $default
     * @param bool $required
     */
    public function __construct($name,$default,$required)
    {
        $this->name = $name;
        $this->required = $required;
        $this->default = $default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }
}