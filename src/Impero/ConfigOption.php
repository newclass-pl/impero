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
 * Class ConfigOption
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ConfigOption
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var mixed
     */
    private $default;
    /**
     * @var bool
     */
    private $required;

    /**
     * ConfigOption constructor.
     * @param string $name
     * @param mixed $default
     * @param bool $required
     */
    public function __construct($name, $default, $required)
    {
        $this->name = $name;
        $this->default = $default;
        $this->required = $required;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->required;
    }
}