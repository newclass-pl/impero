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

use Impero\CommandExecute;
use PHPUnit\Framework\TestCase;
use Test\Asset\CommandAsset;

/**
 * Class CommandExecuteTest
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandExecuteTest extends TestCase
{
    /**
     * @var CommandExecute
     */
    private $command;
    /**
     * @var CommandAsset
     */
    private $commandAsset;

    /**
     *
     */
    public function setUp()
    {
        $this->commandAsset = new CommandAsset();
        $this->command = new CommandExecute($this->commandAsset);
    }

    /**
     *
     */
    public function testExecute()
    {

        $this->command->setSilentMode(true);
        $this->command->execute([
            'required_param',
            'optional_param',
            '-tag="true"',
            '-flag',
            'option'
        ]);
        $this->assertEquals(0, $this->command->getExitCode());
        $this->assertEquals('required_param', $this->commandAsset->getRequiredParam());
        $this->assertEquals('optional_param', $this->commandAsset->getOptionalParam());
        $this->assertEquals('true', $this->commandAsset->getTag());
        $this->assertEquals('option', $this->commandAsset->getFlag());

    }

    /**
     *
     */
    public function testExecuteInvalidParameters()
    {
        $this->expectException(\Impero\ParameterNotFoundException::class);

        $this->command->execute([
            'required_params',
            '-tag',
            'false',
        ]);
    }

}