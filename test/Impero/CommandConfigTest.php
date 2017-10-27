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

namespace Test\Impero;

use Impero\CommandConfig;
use Impero\InputStream;
use PHPUnit\Framework\TestCase;

/**
 * Class CommandConfigTest
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandConfigTest extends TestCase
{

    /**
     *
     */
    public function testGetOption()
    {
        $config = new CommandConfig();
        $config->addOption('first','def',false);
        $option=$config->getOption('first');
        $this->assertEquals('first', $option->getName());
        $this->assertEquals('def', $option->getDefault());
        $this->assertEquals(false, $option->isRequired());
    }

    /**
     *
     */
    public function testGetOptionUnknownOptionException()
    {
        $this->expectExceptionMessage('Unknow option last');
        $config = new CommandConfig();
        $config->addOption('first','def',false);
        $option=$config->getOption('last');
    }

}