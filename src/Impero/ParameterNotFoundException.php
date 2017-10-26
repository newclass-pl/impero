<?php
/**
 * Created by PhpStorm.
 * User: mtomczak
 * Date: 26/10/2017
 * Time: 15:05
 */

namespace Impero;

/**
 * Class ParameterNotFoundException
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class ParameterNotFoundException extends CommandException
{

    /**
     * ParameterNotFoundException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Parameter %s not found.',$name));
    }
}