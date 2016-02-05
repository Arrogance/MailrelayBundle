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

/**
 * Class Client
 *
 * @package Arrogance\MailrelayBundle\Client
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Client extends ClientMethods
{
    /**
     * @var string
     */
    protected $accessPoint;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * Client constructor.
     *
     * @param string $apiKey
     * @param string $access_point
     * @param string $mailrelay_api
     */
    public function __construct($apiKey, $access_point, $mailrelay_api)
    {
        $this->apiKey = $apiKey;
        $this->accessPoint = preg_replace("/__access_point__/i", $access_point, $mailrelay_api);

        $this->connection = new Connection($this);
    }

    /**
     * @return string
     */
    public function getAccessPoint()
    {
        return $this->accessPoint;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
}