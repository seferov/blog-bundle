<?php

/*
 * This file is part of the SeferovBlogBundle package.
 *
 * (c) Farhad Safarov <http://ferhad.in>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class WidgetController
 * @package Seferov\BlogBundle\Controller
 */
class WidgetController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contentAction()
    {
        $contents = $this->getDoctrine()
            ->getManager()
            ->getRepository('SeferovBlogBundle:WidgetContent')
            ->findBy(['status' => true]);

        return $this->render('@SeferovBlog/Widget/_content.html.twig', [
            'contents' => $contents
        ]);
    }
}