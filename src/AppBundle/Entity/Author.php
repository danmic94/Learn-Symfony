<?php
// src/AppBundle/Entity/Author.php
namespace AppBundle\Entity;
// src/AppBundle/Entity/Author.php
// other bundles that are used
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;


class Author
{


    public $name;

    /**
     * @Assert\Choice({"male", "female"})
     */
    protected $gender;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    private $firstName;

    /**
     * @Assert\True(message = "The password cannot match your first name")
     */
    public function isPasswordLegal()
    {
        return $this->firstName !== $this->password;
    }


}