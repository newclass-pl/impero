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
 * Class CommandConfig
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandConfig
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var ConfigParameter[]
     */
    private $parameters=[];
    /**
     * @var ConfigOption[]
     */
    private $options=[];
    /**
     * @var string
     */
    private $description;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CommandConfig
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param bool $required
     * @return $this
     */
    public function addParameter($name, $default=null, $required=true)
    {
        $this->parameters[]=new ConfigParameter($name,$default,$required);
        return $this;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param bool $required
     * @return $this
     */
    public function addOption($name, $default=null,$required=true)
    {
        $this->options[$name]=new ConfigOption($name,$default,$required);
        return $this;
    }

    /**
     * @return ConfigParameter
     */
    public function getParameter($index)
    {
        return $this->parameters[$index]; //TODO detect out of bound
    }

    /**
     * @return ConfigParameter[]
     */
    public function getParameters(){
        return $this->parameters;
    }

    /**
     * @param string $name
     * @return ConfigOption
     * @throws UnknownOptionException
     */
    public function getOption($name)
    {
        if(!isset($this->options[$name])){
            throw new UnknownOptionException($name);
        }

        return $this->options[$name];
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

}