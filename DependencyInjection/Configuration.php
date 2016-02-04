<?php

/*
 * This file is part of the Arrogance MailrelayBundle package.
 *
 * (c) Manuel Raya <manuel@arrogance.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Arrogance\MailrelayBundle\DependencyInjection;

use Arrogance\MailrelayBundle\DefaultConfiguration;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 * @author Manuel Raya <manuel@arrogance.es>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('arrogance_mailrelay');

        $rootNode
            ->children()
            ->scalarNode('access_point')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('api_key')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('mailrelay_api')->defaultValue(DefaultConfiguration::MAILRELAY_API)
            ->end()
            ->end();

        return $treeBuilder;
    }
}
