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
 * Class CommandAlreadyRegisteredException
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandAlreadyRegisteredException extends CommandException
{

    /**
     * CommandAlreadyRegisteredException constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        parent::__construct(sprintf('Command %s already registered.',$name));
    }
}