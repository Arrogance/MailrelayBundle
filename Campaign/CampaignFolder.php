<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Campaign;
use Arrogance\MailrelayBundle\ApiMethodInterface;

/**
 * Class CampaignFolder
 *
 * @package Arrogance\MailrelayBundle\Campaign
 * @author Manuel Raya <manuel@arrogance.es>
 */
class CampaignFolder implements ApiMethodInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return CampaignFolder
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @var integer
     */
    protected $parentId;

    /**
     * CampaignFolder constructor.
     */
    public function __construct()
    {
        $this->parentId = -1;
    }

    /**
     * @return int
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param int $parentId
     *
     * @return CampaignFolder
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'name' => $this->name,
            'parentId' => $this->parentId
        ];
    }
}