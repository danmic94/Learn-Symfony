<?php
// src/AppBundle/Form/Type/CategoryType.php
namespace AppBundle\Form\Type;


use AppBundle\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('category', new CategoryType());
    }
    public  function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
           'data_class' => 'AppBundle\Entity\Category',
        ));
    }
    public function getName()
    {
        return 'category';
    }
}