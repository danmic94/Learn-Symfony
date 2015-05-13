<?php
// src/AppBundle/Entity/User.php
namespace AppBundle\Entity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @Assert\GroupSequence({"User", "Strict"})
 */
/**
 * @Assert\GroupSequenceProvider
 */
class User implements UserInterface
{
    /**
     * @Assert\NotBlank()
     */
    private $name;
    /**
     * @Assert\CardScheme(
     * schemes={"VISA"},
     * groups={"Premium"},
     * )
     */
    private $creditCard;
    /**
     * @Assert\NotBlank
     */
    private $username;
    /**
     * @Assert\NotBlank
     */
    private $password;
    /**
     * @Assert\True(message="The password cannot match your username", groups={"Strict"})
     */
    public function isPasswordLegal()
    {
        return ($this->username !== $this->password);
    }

    public function getGroupSequence()
    {
        $groups = array('User');
        if ($this->isPremium()) {
            $groups[] = 'Premium';
        }
        return $groups;
    }
}