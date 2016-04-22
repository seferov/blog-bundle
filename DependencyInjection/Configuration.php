<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <https://farhadsafarov.com>
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
                ->integerNode('max_posts_per_page')
                    ->defaultValue(6)
                ->end()
                ->scalarNode('layout')
                    ->cannotBeEmpty()
                    ->defaultValue('SeferovBlogBundle::layout.html.twig')
                ->end()
                ->arrayNode('widgets')
                    ->children()
                        ->arrayNode('facebook')
                            ->children()
                                ->scalarNode('app_id')->end()
                                ->scalarNode('locale')->defaultValue('en_US')->end()
                                ->scalarNode('version')->defaultValue('v2.6')->end()
                                ->arrayNode('page')
                                    ->children()
                                        ->scalarNode('username')->end()
                                        ->scalarNode('name')->end()
                                    ->end()
                                ->end()
                                ->arrayNode('comments')
                                    ->children()
                                        ->integerNode('numposts')->defaultValue(10)->end()
                                        ->integerNode('width')->end()
                                    ->end()
                                ->end()
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
