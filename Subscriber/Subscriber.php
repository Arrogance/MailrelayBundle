<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Subscriber;

use Arrogance\MailrelayBundle\ApiMethodInterface;

/**
 * Class Subscriber
 *
 * @package Arrogance\MailrelayBundle\Subscriber
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Subscriber implements ApiMethodInterface
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $groups;

    /**
     * @var array
     */
    protected $customFields;

    /**
     * Subscriber constructor.
     */
    public function __construct()
    {
        $this->groups = array();
        $this->customFields = array();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

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
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param integer $groupId
     *
     * @return $this
     */
    public function addGroup($groupId)
    {
        $this->groups[] = $groupId;

        return $this;
    }

    /**
     * @return array
     */
    public function getGroups()
    {
        return $this->groups;
    }

    /**
     * @param array $groups
     *
     * @return $this
     */
    public function setGroups($groups)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return $this
     */
    public function addCustomField($name, $value)
    {
        $this->customFields[] = array(
            $name => $value
        );

        return $this;
    }

    /**
     * @return array
     */
    public function getCustomFields()
    {
        return $this->customFields;
    }

    /**
     * @param array $customFields
     *
     * @return $this
     */
    public function setCustomFields($customFields)
    {
        $this->customFields = $customFields;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $array = array(
            'name' => $this->name,
            'email' => $this->email,
            'groups' => $this->groups
        );

        if($this->customFields) {
            $array['customFields'] = $this->customFields;
        }

        return $array;
    }
}