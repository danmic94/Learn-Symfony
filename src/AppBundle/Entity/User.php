<?php
// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
class User implements UserInterface
{

    /**
     * @Assert\Email(groups={"registration"})
     */
    private $email;
    /**
    * @Assert\NotBlank(groups={"registration"})
    * @Assert\Length(min=7, groups={"registration"})
    * */
    private $password;
    /**
     * @Assert\Length(min=2)
     */
    private $city;
}