<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="cuerpo", type="text")
     */
    private $cuerpo;

    /**
     * @var date
     *
     * @ORM\Column(name="fechaDeCreacion", type="string")
     */
    private $fechaDeCreacion;

    /**
     * @var string
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="categorias")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     */
    private $estado;


    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="posts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $author;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Post
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     *
     * @return Post
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;

        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set fechaDeCreacion
     *
     * @param string $fechaDeCreacion
     *
     * @return Post
     */
    public function setFechaDeCreacion($fechaDeCreacion)
    {
        $this->fechaDeCreacion = $fechaDeCreacion;

        return $this;
    }

    /**
     * Get fechaDeCreacion
     *
     * @return string
     */
    public function getFechaDeCreacion()
    {
        return $this->fechaDeCreacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Post
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set idUsuario
     *
     * @param integer $author
     *
     * @return Post
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get idUsuario
     *
     * @return int
     */
    public function getAuthor()
    {
        return $this->author;
    }
}
