<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Post;
/**
 * Background
 *
 * @ORM\Table(name="background")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BackgroundRepository")
 */
class Background
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
     * @ORM\Column(name="backgroundImage", type="string", length=255)
     */
    private $backgroundImage;

    /**
     * @var string
     *
     * @ORM\Column(name="backgroundColor", type="string", length=6)
     */
    private $backgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="fontColor", type="string", length=6)
     */
    private $fontColor;

    /**
     * @var Post
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Post")
     */
    private $post;


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
     * Set backgroundImage
     *
     * @param string $backgroundImage
     *
     * @return Background
     */
    public function setBackgroundImage($backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;

        return $this;
    }

    /**
     * Get backgroundImage
     *
     * @return string
     */
    public function getBackgroundImage()
    {
        return $this->backgroundImage;
    }

    /**
     * Set backgroundColor
     *
     * @param string $backgroundColor
     *
     * @return Background
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set fontColor
     *
     * @param string $fontColor
     *
     * @return Background
     */
    public function setFontColor($fontColor)
    {
        $this->fontColor = $fontColor;

        return $this;
    }

    /**
     * Get fontColor
     *
     * @return string
     */
    public function getFontColor()
    {
        return $this->fontColor;
    }

    /**
     * Set poem
     *
     * @param Post $post
     *
     * @return Background
     */
    public function setPost(Post $post = null)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get poem
     *
     * @return Post
     */
    public function getPost()
    {
        return $this->post;
    }
}
