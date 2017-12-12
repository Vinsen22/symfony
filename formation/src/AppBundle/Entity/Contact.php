<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="nom", type="string", length=100)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=100)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=150)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**

 * @ORM\ManyToMany(targetEntity="Hobby")
 * @ORM\JoinTable(name="contact_hobbies",
 *      joinColumns={@ORM\JoinColumn(name="contact_id", referencedColumnName="id")},
 *      inverseJoinColumns={@ORM\JoinColumn(name="hobby_id", referencedColumnName="id")}
 *      )
 */

    private $hobbies; // L'attribut qui decoule du many to may

    /**
     * @ORM\ManyToOne(targetEntity="OperatingSystem")
     * @ORM\JoinColumn(name="operating_system_id",referencedColumnName="id")
     */
    private $operatingSystem;
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Contact
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Contact
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->hobbies = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add hobby
     *
     * @param \AppBundle\Entity\Hobby $hobby
     *
     * @return Contact
     */
    public function addHobby(\AppBundle\Entity\Hobby $hobby)
    {
        $this->hobbies[] = $hobby;

        return $this;
    }

    /**
     * Remove hobby
     *
     * @param \AppBundle\Entity\Hobby $hobby
     */
    public function removeHobby(\AppBundle\Entity\Hobby $hobby)
    {
        $this->hobbies->removeElement($hobby);
    }

    /**
     * Get hobbies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * Set operatingSystem
     *
     * @param \AppBundle\Entity\OperatingSystem $operatingSystem
     *
     * @return Contact
     */
    public function setOperatingSystem(\AppBundle\Entity\OperatingSystem $operatingSystem = null)
    {
        $this->operatingSystem = $operatingSystem;

        return $this;
    }

    /**
     * Get operatingSystem
     *
     * @return \AppBundle\Entity\OperatingSystem
     */
    public function getOperatingSystem()
    {
        return $this->operatingSystem;
    }
}
