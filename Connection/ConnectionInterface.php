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
 * Interface ConnectionInterface
 *
 * @package Arrogance\MailrelayBundle\Connection
 * @author Manuel Raya <manuel@arrogance.es>
 */
interface ConnectionInterface
{
    public function __construct(Client $client);
    public function get($apiMethod, array $config);
}