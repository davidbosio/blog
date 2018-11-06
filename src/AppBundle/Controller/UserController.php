<?php

namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends Controller
{
  /**
     * @Route("profile/posts", name="profile_posts")
     */
    public function profileAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('author' => $user));


        return $this->render('post/profile_posts.html.twig', [
            'posts' => $posts,
        ]);
    }
}
?>