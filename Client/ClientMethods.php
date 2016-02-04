<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Client;

use Arrogance\MailrelayBundle\Connection\Connection;
use Arrogance\MailrelayBundle\Email\Email;

/**
 * Class ClientMethods
 *
 * @package Arrogance\MailrelayBundle\Client
 * @author Manuel Raya <manuel@arrogance.es>
 */
abstract class ClientMethods
{
    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @param array $options
     *
     * @return object The response
     */
    public function getMailboxes(array $options = [])
    {
        return $this->connection->get('getMailboxes', $options);
    }

    /**
     * @param array $options
     *
     * @return object The response
     */
    public function getPackages(array $options = [])
    {
        return $this->connection->get('getPackages', $options);
    }

    /**
     * @param Email $email
     *
     * @return mixed
     */
    public function sendMail(Email $email)
    {
        return $this->connection->get('sendMail', $email->toArray());
    }
}