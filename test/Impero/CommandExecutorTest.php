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

use Impero\CommandExecutor;
use PHPUnit\Framework\TestCase;
use Test\Asset\CommandAsset;
use Test\Asset\CommandSumAsset;

/**
 * Class CommandExecutorTest
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandExecutorTest extends TestCase
{
    /**
     * @var CommandExecutor
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
        $this->command = new CommandExecutor();
        $this->command->register($this->commandAsset);
        $this->command->register(new CommandSumAsset());
    }

    /**
     *
     */
    public function testPrintAvailableCommands()
    {
        $this->expectOutputString("default - Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nsum - Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n");
        $this->command->printAvailableCommands();
    }

    /**
     *
     */
    public function testExecute()
    {
        $this->expectOutputString("7");
        $this->command->execute([
            'file.php',
            'sum',
            '2',
            '-two="5"'
        ]);

    }

    /**
     *
     */
    public function testExecuteEmpty()
    {
        $this->expectOutputString("default - Lorem ipsum dolor sit amet, consectetur adipiscing elit.\nsum - Lorem ipsum dolor sit amet, consectetur adipiscing elit.\n");
        $this->command->execute([
            'file.php'
        ]);

    }

    /**
     *
     */
    public function testExecuteCommandNotFoundException()
    {
        $this->expectExceptionMessage('Command unknown not found');
        $this->command->execute([
            'file.php',
            'unknown'
        ]);

    }
}