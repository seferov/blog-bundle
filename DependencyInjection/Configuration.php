<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('seferov_blog');

        $rootNode
            ->children()
                ->scalarNode('layout')
                    ->cannotBeEmpty()
                    ->defaultValue('SeferovBlogBundle::layout.html.twig')
                ->end()
                ->arrayNode('widgets')
                    ->children()
                        ->arrayNode('facebook')
                            ->children()
                                ->scalarNode('app_id')->end()
                                ->scalarNode('username')->end()
                                ->scalarNode('name')->end()
                            ->end()
                        ->end()
                        ->arrayNode('disqus')
                            ->children()
                                ->scalarNode('username')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
