<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\Connection;
use Arrogance\MailrelayBundle\Client\Client;

/**
 * Class Connection
 *
 * @package Arrogance\MailrelayBundle\Connection
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Connection implements ConnectionInterface
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var object
     */
    public $response;

    /**
     * Connection constructor.
     *
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function get($apiMethod, array $config = array())
    {
        $postData = [
            'function' => $apiMethod,
            'apiKey' => $this->client->getApiKey()
        ];

        $postData = array_merge($postData, $config);

        return $this->prepareCurlPostOptions($postData);
    }

    /**
     * @return resource
     */
    protected function initConnection()
    {
        return curl_init($this->client->getAccessPoint());
    }

    /**
     * @param $postData
     *
     * @return mixed
     */
    protected function prepareCurlPostOptions($postData)
    {
        $connection = $this->initConnection();

        curl_setopt($connection, CURLOPT_POST, true);
        curl_setopt($connection, CURLOPT_POSTFIELDS, http_build_query($postData));
        curl_setopt($connection, CURLOPT_RETURNTRANSFER, 1);

        return $this->processResponse(json_decode(curl_exec($connection)));
    }

    /**
     * @param $response
     *
     * @return mixed
     * @throws \Exception
     */
    protected function processResponse($response)
    {
        if($response->status == 0) {
            throw new \Exception("Mailrelay API Exception: {$response->error}");
        }

        return $response;
    }
}