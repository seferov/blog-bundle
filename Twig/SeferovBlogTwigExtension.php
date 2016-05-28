<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Twig;

/**
 * Class SeferovBlogTwigExtension
 * @package Seferov\BlogBundle\Twig
 */

class SeferovBlogTwigExtension extends \Twig_Extension
{
    /**
     * @var array
     */
    private $config;

    /**
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('excerpt', array($this, 'excerptFilter')),
            new \Twig_SimpleFilter('slugify', array($this, 'slugifyFilter')),
        ];
    }

    /**
     * @param $word
     * @return string
     */
    public function slugifyFilter($word)
    {
        return str_replace(' ', '_', trim($word));
    }

    /**
     * @param $text
     * @param int $limit
     * @return string
     */
    public function excerptFilter($text, $limit = 100)
    {
        // Limit content with numbers to create an excerpt
        $limited = mb_substr($text, 0, $limit, 'UTF-8');

        return html_entity_decode($limited, ENT_COMPAT, 'UTF-8');
    }

    /**
     * {@inheritdoc}
     */
    public function getGlobals()
    {
        return ['seferov_blog_config' => $this->config];
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'seferov_blog_twig_extension';
    }
}
