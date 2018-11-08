<?php
namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use Symfony\Component\Routing\Annotation\Route;






/**
 * @Route("/posts")
 */
class PostController extends Controller
{


    /**
     * @Route("/list/{author}", name="list_posts")
     */
    public function listAction($author = null)
    {
        $servicios = $this->get("app.postsService");
        if(!is_null($author)) {
            $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findBy(array('author' => $author));
        } else {
            $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        }

        return $this->render('post/list.html.twig', [
            'posts' => $posts,
            'servicios'=>  $servicios

        ]);
    }

    /**
     * @Route("/view/{idPost}", name="view_post")
     */
    public function viewAction($idPost)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($idPost);
        $servicios = $this->get("app.postsService");
        return $this->render('post/view.html.twig', array(
            'post' => $post,
            'cuerpoCambiado'=> $servicios->changeBody($post->getCuerpo()),
        ));
    }

    /**
     * @Route("/create/", name="create_post")
     */
    public function createAction(Request $request)
    {
        $post = new Post();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form= $this->createForm(PostType::Class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $post=$form->getData();
            $servicios = $this->get('app.postsService');
            $cuerpoCambiado = $servicios->changeBody($post->getCuerpo());
            $post->setCuerpo($cuerpoCambiado);
            $post->setAuthor($user);
            $post->setFechaDeCreacion(date('Y-m-d'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirect('/posts/view/'.$post->getId());

        }
        return $this->render('post/form_create.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/update/{idPost}", name="update_post")
     */
    public function updateAction($idPost, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($idPost);
        /** @var $post Post */
        $form= $this->createForm(PostType::Class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $post=$form->getData();
            $servicios = $this->get("app.postsService");
            $cuerpoCambiado = $servicios->changeBody($post->getCuerpo());
            $post->setCuerpo($cuerpoCambiado);
            $post->setFechaDeCreacion(date('Y-m-d'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
            return $this->redirect('/posts/view/'.$post->getId());

        }
        return $this->render('post/form_update.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/toPublic/{idPost}", name="toPublic_post")
     */
    public function toPublicAction($idPost)
    {
        $em = $this->getDoctrine()->getManager();
        $cat=$em->getRepository('AppBundle:Categoria')->findOneBy(array('descripcion' => 'Activo'));
        $post = $em->getRepository('AppBundle:Post')->find($idPost);
        /** @var $post Post */
        $post->setEstado($cat);
        $em->persist($post);
        $em->flush();
        return $this->redirectToRoute('list_posts');
    }

    /**
     * @Route("/delete/{idPost}", name="delete_post")
     */
    public function deleteAction($idPost)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($idPost);
        $em->remove($post);
        $em->flush();
        return $this->redirectToRoute('list_posts');

    }
}

?>