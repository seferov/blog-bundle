<?php

/*
 * (c) Farhad Safarov <https://farhadsafarov.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Seferov\BlogBundle\Controller\Admin;

use Cocur\Slugify\Slugify;
use Seferov\BlogBundle\Entity\Post;
use Seferov\BlogBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('@SeferovBlog/Admin/index.html.twig');
    }

    /**
     * @todo pagination
     */
    public function postsAction()
    {
        $posts = $this->getDoctrine()
            ->getManager()
            ->getRepository('SeferovBlogBundle:Post')
            ->findAll();
        
        return $this->render('@SeferovBlog/Admin/posts.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addPostAction(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugify = new Slugify(['rulesets' => ['default', 'turkish']]);
            $post->setTitleSlug($slugify->slugify($post->getTitle()))
                ->setCreatedAt(new \DateTime('now'))
                ->setMonth(date('m'))
                ->setYear(date('Y'))
                ->setStatus(true)
            ;

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('seferov_blog_admin_edit_post', [
                'id' => $post->getId()
            ]);
        }

        return $this->render('@SeferovBlog/Admin/post.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editPostAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var Post $post */
        $post = $em->getRepository('SeferovBlogBundle:Post')->find($id);

        if (!$post) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slugify = new Slugify(['rulesets' => ['default', 'turkish']]);
            $post->setTitleSlug($slugify->slugify($post->getTitle()));

            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('seferov_blog_admin_edit_post', [
                'id' => $id
            ]);
        }

        return $this->render('@SeferovBlog/Admin/post.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
