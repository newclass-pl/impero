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
 * Class CommandAsset
 * @author Michal Tomczak (michal.tomczak@newclass.pl)
 */
class CommandAsset implements CommandInterface
{
    /**
     * @var mixed
     */
    private $optionalParam;
    /**
     * @var mixed
     */
    private $requiredParam;
    /**
     * @var mixed
     */
    private $tag;
    /**
     * @var mixed
     */
    private $flag;
    /**
     * @var string
     */
    private $name;

    /**
     * CommandAsset constructor.
     * @param string $name
     */
    public function __construct($name='default')
    {
        $this->name = $name;
    }

    /**
     * @param CommandConfig $commandConfig
     */
    public function doConfig(CommandConfig $commandConfig)
    {
        $commandConfig->setName($this->name)
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipiscing elit.')
            ->addParameter('required-param')
            ->addParameter('optional-param', null, false)
            ->addOption('tag', true)
            ->addOption('flag');
    }

    /**
     * @param InputStream $in
     * @param OutputStream $out
     * @return int|void
     */
    public function doExecute(InputStream $in, OutputStream $out)
    {

        $this->requiredParam = $in->getValue('required-param');
        $this->optionalParam = $in->getValue('optional-param');
        $this->tag = $in->getValue('tag');
        $this->flag = $in->getValue('flag');

    }

    /**
     * @return mixed
     */
    public function getOptionalParam()
    {
        return $this->optionalParam;
    }

    /**
     * @return mixed
     */
    public function getRequiredParam()
    {
        return $this->requiredParam;
    }

    /**
     * @return mixed
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return mixed
     */
    public function getFlag()
    {
        return $this->flag;
    }
}