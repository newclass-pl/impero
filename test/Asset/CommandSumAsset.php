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

namespace Test\Asset;


use Impero\CommandConfig;
use Impero\CommandInterface;
use Impero\InputStream;
use Impero\OutputStream;

/**
 * Class CommandSumAsset
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandSumAsset implements CommandInterface
{
    /**
     * @param CommandConfig $commandConfig
     */
    public function doConfig(CommandConfig $commandConfig)
    {
        $commandConfig->setName('sum')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->addParameter('one')
            ->addOption('two');
    }

    /**
     * @param InputStream $in
     * @param OutputStream $out
     * @return int|void
     */
    public function doExecute(InputStream $in, OutputStream $out)
    {
        echo $in->getValue('one')+$in->getValue('two');
    }
}