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
 * Interface CommandInterface
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
interface CommandInterface
{
    /**
     * @param CommandConfig $commandConfig
     * @return void
     */
    public function doConfig(CommandConfig $commandConfig);

    /**
     * @param InputStream $in
     * @param OutputStream $out
     * @return int|void
     */
    public function doExecute(InputStream $in,OutputStream $out);
}