<?php

namespace AppBundle\Model;

use Symfony\Bridge\Doctrine\Validator\Constraints as Assert;
use AppBundle\Validator\Constraints as AppAssert;

/**
 * Class Post
 * @package AppBundle\Model
 *
 * @AppAssert\ImageOrColorIsSet
 *
 */
class Post
{
    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $author;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $poem;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $createdAt;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $fontColor;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $backgroundColor;

    /**
     * @var string
     * @Assert\NotBlank()
     */
    private $backgroundImage;

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(?string $title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getAuthor(): ?string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(?string $author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getPost(): ?string
    {
        return $this->poem;
    }

    /**
     * @param string $poem
     */
    public function setPost(?string $poem)
    {
        $this->poem = $poem;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(?string $createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string
     */
    public function getFontColor(): ?string
    {
        return $this->fontColor;
    }

    /**
     * @param string $fontColor
     */
    public function setFontColor(?string $fontColor)
    {
        $this->fontColor = $fontColor;
    }

    /**
     * @return string
     */
    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    /**
     * @param string $backgroundColor
     */
    public function setBackgroundColor(?string $backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return string
     */
    public function getBackgroundImage(): ?string
    {
        return $this->backgroundImage;
    }

    /**
     * @param string $backgroundImage
     */
    public function setBackgroundImage(?string $backgroundImage)
    {
        $this->backgroundImage = $backgroundImage;
    }
}
