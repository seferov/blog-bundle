<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://ferhad.in>
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
 * PostRepository
 *
 */
class PostRepository extends EntityRepository
{
    /**
     * @param int $page
     * @return bool|Pagerfanta
     */
    public function getListPosts($page = 1)
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.created_at', 'DESC')
            ->getQuery();

        $posts = new Pagerfanta(new DoctrineORMAdapter($query));
        $posts->setMaxPerPage(6);

        try {
            $posts->setCurrentPage($page);
        } catch(NotValidCurrentPageException $e) {
            //throw new NotFoundHttpException();
            return false;
        }

        return $posts;
    }
}