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
 * Class CommandExecutor
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandExecutor
{
    /**
     * @var CommandExecute[]
     */
    private $commands=[];

    /**
     * @param CommandInterface $command
     * @throws CommandAlreadyRegisteredException
     */
    public function register(CommandInterface $command){
        $commandExecute=new CommandExecute($command);
        $name=$commandExecute->getName();
        if(isset($this->commands[$name])){
            throw new CommandAlreadyRegisteredException($name);
        }
        $this->commands[$name]=$commandExecute;
    }

    /**
     * @param mixed[] $argv
     * @throws CommandNotFoundException
     */
    public function execute($argv){
        $parameters=$argv;

        array_shift($parameters);
        $name=array_shift($parameters);

        if(null === $name){
            $this->printAvailableCommands();
            return;
        }

        foreach($this->commands as $command){
            if($command->getName()!==$name){
                continue;
            }

            $command->execute($parameters);
            return;
        }

        throw new CommandNotFoundException($name);
    }

    /**
     *
     */
    public function printAvailableCommands(){
        $out=new OutputStream();
        foreach($this->commands as $command){
            $out->writeLn($command->getName().' - '.$command->getDescription());
        }
    }
}