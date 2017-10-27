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
 * Class InputStreamTest
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class InputStreamTest extends TestCase
{

    /**
     *
     */
    public function testParse()
    {
        $config = new CommandConfig();
        $config->addParameter('first')
            ->addParameter('second_optional', null, false)
            ->addParameter('last_default', true)
            ->addOption('opt1')
            ->addOption('opt2', null, false);

        $input = new InputStream([
            'test',
            '-opt1="wow"'
        ], $config);

        $this->assertEquals('test', $input->getValue('first'));
        $this->assertEquals(true, $input->getValue('last_default'));
        $this->assertEquals('wow', $input->getValue('opt1'));

    }

    /**
     *
     */
    public function testParseRequiredParameterException()
    {
        $config = new CommandConfig();
        $config->addParameter('first')
            ->addParameter('second_optional', null, false)
            ->addParameter('last_default', true)
            ->addOption('opt1')
            ->addOption('opt2', null, false);

        $this->expectExceptionMessage('Required parameter first');
        $input = new InputStream([
            '-opt1="wow"',
            '-opt2',
            'unknown'
        ], $config);

    }
}