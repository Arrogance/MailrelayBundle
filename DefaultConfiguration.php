<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle;

/**
 * Class DefaultConfiguration
 *
 * @package Arrogance\MailrelayBundle\DependencyInjection
 * @author Manuel Raya <manuel@arrogance.es>
 */
class DefaultConfiguration
{
    /**
     * MAILRELAY_API is the implementation of json api access point of Mailrelay.
     * To update if Mailrelay updates their api. This is the default value for configuration.
     *
     * @var string
     */
    const MAILRELAY_API = 'https://__access_point__/ccm/admin/api/version/2/&type=json';
}