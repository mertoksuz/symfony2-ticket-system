<?php

namespace Mert\TicketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Ticket
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Ticket
{

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAt()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();

        $this->user = new ArrayCollection();
        $this->category = new ArrayCollection();
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAt()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="tickets")
     * @ORM\JoinColumn(name="category", referencedColumnName="id")
     */
    protected $category;

    /**
     * @var integer
     *
     * @ORM\Column(name="priority", type="integer")
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="attachment", type="string", length=255)
     * @Assert\File(maxSize="6000000")
     */
    private $attachment;

    public function getAbsolutePath()
    {
        return null === $this->attachment
            ? null
            : $this->getUploadRootDir().'/'.$this->attachment;
    }

    public function getWebPath()
    {
        return null === $this->attachment
            ? null
            : $this->getUploadDir().'/'.$this->attachment;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }


    /**
     * @var boolean
     *
     * @ORM\Column(name="is_solved", type="boolean")
     */
    private $is_solved;


    /**
     * @var integer
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_tickets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

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
     * @return Ticket
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
     * Set content
     *
     * @param string $content
     *
     * @return Ticket
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }



    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return Ticket
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set attachment
     *
     * @param UploadedFile $attachment
     */
    public function setAttachment(UploadedFile $attachment = null)
    {
        $this->attachment = $attachment;

    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set isSolved
     *
     * @param boolean $isSolved
     *
     * @return Ticket
     */
    public function setIsSolved($isSolved)
    {
        $this->is_solved = $isSolved;

        return $this;
    }

    /**
     * Get isSolved
     *
     * @return boolean
     */
    public function getIsSolved()
    {
        return $this->is_solved;
    }


    /**
     * Set user
     *
     * @param \Mert\TicketBundle\Entity\User $user
     *
     * @return Ticket
     */
    public function setUser(\Mert\TicketBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Mert\TicketBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param \Mert\TicketBundle\Entity\Category $category
     *
     * @return Ticket
     */
    public function setCategory(\Mert\TicketBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Mert\TicketBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
