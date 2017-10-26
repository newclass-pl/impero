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
 * Class InputStream
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class InputStream
{
    /**
     * @var mixed[]
     */
    private $values = [];

    /**
     * InputStream constructor.
     * @param mixed[] $parameters
     * @param CommandConfig $commandConfig
     */
    public function __construct($parameters, CommandConfig $commandConfig)
    {
        $this->parse($parameters, $commandConfig);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws ParameterNotFoundException
     */
    public function getValue($name)
    {
        if(!array_key_exists($name,$this->values)){
            throw new ParameterNotFoundException($name);
        }

        return $this->values[$name];
    }

    /**
     * @param mixed[] $parameters
     * @param CommandConfig $commandConfig
     */
    private function parse($parameters, CommandConfig $commandConfig)
    {
        $configParametersIndex=0;
        $configParameters=$commandConfig->getParameters();
        for ($i = 0; $i < count($parameters); $i++) {
            $parameter = $parameters[$i];
            if (preg_match('/^-.+/', $parameter)) {
                $this->parseOption($i, $parameters, $commandConfig);
                continue;
            }

            $this->parseParameter($parameters[$i], $commandConfig->getParameter($configParametersIndex++));
        }

        for($i=$configParametersIndex; $i<count($configParameters); $i++){
            $this->parseParameter(null,$configParameters[$i]);
        }
    }

    /**
     * @param int $index
     * @param mixed[] $parameters
     * @param CommandConfig $config
     * @throws RequiredParameterException
     */
    private function parseOption(&$index, $parameters, CommandConfig $config)
    {
        $node = $parameters[$index];
        preg_match('/-(.+?)(?:$|=(.+))/', $node, $group);
        $name = $group[1];
        $value = (isset($group[2])?trim($group[2],'"'):null);
        if (null === $value) {
            $value = $parameters[++$index];
        }
        $option = $config->getOption($name);
        if ($option->isRequired() && null === $value) {
            throw new RequiredParameterException('-' . $name);
        }

        if (null !== $option->getDefault() && null === $value) {
            $value = $option->getDefault();
        }

        $this->values[$name] = $value;
    }

    /**
     * @param mixed $value
     * @param ConfigParameter $config
     * @throws RequiredParameterException
     */
    private function parseParameter($value, ConfigParameter $config)
    {
        if ($config->isRequired() && null === $value) {
            throw new RequiredParameterException($config->getName());
        }

        if (null !== $config->getDefault() && null === $value) {
            $value = $config->getDefault();
        }

        $this->values[$config->getName()] = $value;
    }
}