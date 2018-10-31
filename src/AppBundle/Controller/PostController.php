<?php
namespace AppBundle\Controller;

use AppBundle\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends Controller
{

    /**
     * @Route("posts/list", name="list_posts")
     */
    public function listAction()
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:Post')->findAll();
        dump($posts);
        return $this->render('post/list.html.twig', [
            'posts' => $posts,

        ]);
    }

    /**
     * @Route("/posts/view/{idPost}", name="view_post")
     */
    public function viewAction($idPost)
    {
        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->find($idPost);

        return $this->render('post/view.html.twig', array(
            'titulo' => $post->gettitulo(),
            'fecha' => $post->getFechaDeCreacion(),
            'cuerpo' => $post->getCuerpo(),
            'estado' => $post->getEstado(),
            'idUsuario' => $post->getIdUsuario(),

        ));
    }

    /**
     * @Route("/posts/create/", name="create_post")
     */
    public function createAction(Request $request)
    {

        $post = new Post();
        $form= $this->createForm(PostType::Class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $post=$form->getData();
            $post->setFechaDeCreacion(date('Y-m-d'));
            $em=$this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
          //  return $this->redirectToRoute('list_posts');
            return $this->redirect('/posts/view/'.$post->getId());

        }
        return $this->render('post/form_create.html.twig', array('form'=>$form->createView()));
    }

    /**
     * @Route("/posts/update/{id}", name="update_post")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($id);
        /** @var $post Post */
        $post->setTitulo('actualizado');
        $post->setCuerpo("cuerpo");
        $post->setFechaDeCreacion("22/10/1997");
        $post->setEstado("borrador");
        $post->setIdUsuario('1');
        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('list_posts');
    }

    /**
     * @Route("/posts/delete/{postId}", name="delete_post")
     */
    public function deleteAction($postId)
    {
        $em = $this->getDoctrine()->getManager();
        $post = $em->getRepository('AppBundle:Post')->find($postId);
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('list_posts');

    }
}

?>