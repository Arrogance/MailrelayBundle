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
     * Set the return data type for several api functions.
     *
     * @param string $type Options: array, csv, xml, json.
     *
     * @return mixed
     */
    public function setReturnType($type)
    {
        return $this->connection->get('setReturnType', [ 'returnType' => $type ]);
    }

    /**
     * Get a list of smtp tags.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getSmtpTags(array $options = [])
    {
        return $this->connection->get('getSmtpTags', $options);
    }

    /**
     * Get sent messages processed by Mailrelay system.
     *
     * @param array $options
     *
     * @return object The response
     */
    public function getSends(array $options = [])
    {
        return $this->connection->get('getSends', $options);
    }

    /**
     * Get bounced messages within a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array  $options
     *
     * @return mixed
     */
    public function getDeliveryErrors($date, array $options = [])
    {
        return $this->connection->get('getDeliveryErrors', array_merge([ 'date' => $date ], $options));
    }

    /**
     * Get the full day log for a specified date.
     *
     * @param string $date Date in the following format: YYYY-MM-DD
     * @param array $options
     *
     * @return mixed
     */
    public function getDayLog($date, array $options = [])
    {
        return $this->connection->get('getDayLog', array_merge([ 'date' => $date ], $options));
    }

    /**
     * Get the number of messages sent to the specified recipient.
     *
     * @param string $email Recipient email
     * @param string $date Date in the following format: YYYY-MM-DD
     *
     * @return mixed
     */
    public function getMailRcptNumber($email, $date)
    {
        return $this->connection->get('getMailRcptNumber', [ 'email'  => $email, 'date' => $date ]);
    }

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