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
 * Class CommandExecute
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandExecute
{
    /**
     * @var CommandConfig
     */
    private $config;
    /**
     * @var CommandInterface
     */
    private $command;
    /**
     * @var boolean
     */
    private $silentMode = false;
    /**
     * @var int
     */
    private $exitCode=0;

    /**
     * CommandExecute constructor.
     * @param CommandInterface $command
     */
    public function __construct(CommandInterface $command)
    {
        $this->config = new CommandConfig();
        $this->command = $command;
        $command->doConfig($this->config);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->config->getName();
    }

    /**
     * Disable throw exception
     * @param boolean $flag
     */
    public function setSilentMode($flag)
    {
        $this->silentMode = $flag;
    }

    /**
     * @return int
     */
    public function getExitCode()
    {
        return $this->exitCode;
    }

    /**
     * @param mixed[] $parameters
     * @throws \Exception
     */
    public function execute($parameters = [])
    {
        $in = new InputStream($parameters, $this->config);

        try {
            $this->exitCode = $this->command->doExecute($in, new OutputStream())?:0;
        } catch (\Exception $e) {
            $this->exitCode = 1;
            if (!$this->silentMode) {
                throw $e;
            }
        }
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->config->getDescription();
    }
}