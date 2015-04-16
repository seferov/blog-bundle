<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://ferhad.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Twig;

/**
 * Class SeferovTwigExtension
 * @package Seferov\AppBundle\Twig
 * @author Farhad Safarov <ferhad@azerdict.com>
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
        return mb_substr($text, 0, $limit, 'UTF-8');
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