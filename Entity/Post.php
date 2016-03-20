<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Post
 */
class Post
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $title_slug;

    /**
     * @var string
     */
    private $post;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var string
     */
    private $month;

    /**
     * @var integer
     */
    private $year;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $coverImage;

    /**
     * @var boolean
     */
    private $status;

    /**
     * @var integer
     */
    private $redirectTo;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set titleSlug
     *
     * @param string $titleSlug
     *
     * @return Post
     */
    public function setTitleSlug($titleSlug)
    {
        $this->title_slug = $titleSlug;

        return $this;
    }

    /**
     * Get titleSlug
     *
     * @return string
     */
    public function getTitleSlug()
    {
        return $this->title_slug;
    }

    /**
     * Set post
     *
     * @param string $post
     *
     * @return Post
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set month
     *
     * @param string $month
     *
     * @return Post
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return string
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Post
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set author
     *
     * @param string $author
     *
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Post
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set redirectTo
     *
     * @param integer $redirectTo
     *
     * @return Post
     */
    public function setRedirectTo($redirectTo)
    {
        $this->redirectTo = $redirectTo;

        return $this;
    }

    /**
     * Get redirectTo
     *
     * @return integer
     */
    public function getRedirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * @return string
     */
    public function getCoverImage()
    {
        return $this->coverImage;
    }

    /**
     * @param string $coverImage
     */
    public function setCoverImage($coverImage)
    {
        $this->coverImage = $coverImage;
    }
}
