<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <https://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Exception\NotValidCurrentPageException;

/**
 * Class PostRepository
 * @package Seferov\BlogBundle\Entity
 */
class PostRepository extends EntityRepository
{
    /**
     * @param int $page
     * @param $limit
     * @return bool|Pagerfanta
     */
    public function getListPosts($page, $limit)
    {
        $query = $this->createQueryBuilder('p')
            ->where('p.redirectTo is null')
            ->orderBy('p.id', 'DESC')
            ->getQuery();

        $posts = new Pagerfanta(new DoctrineORMAdapter($query));
        $posts->setMaxPerPage($limit);

        try {
            $posts->setCurrentPage($page);
        } catch (NotValidCurrentPageException $e) {
            return false;
        }

        return $posts;
    }

    /**
     * @param int $limit
     * @return array
     */
    public function getPosts($limit = 5)
    {
        return $this->createQueryBuilder('p')
            ->where('p.redirectTo is null')
            ->orderBy('p.id', 'desc')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
