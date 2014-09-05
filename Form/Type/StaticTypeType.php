<?php

namespace FDevs\StaticPageBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StaticTypeType extends AbstractType
{
    /** @var array */
    private $choices = [];

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'fdevs_static_type';
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $choices = array_flip(array_map(
            function ($val) {
                return implode('|', $val);
            },
            $this->choices
        ));

        $resolver->setDefaults(['choices' => $choices]);
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return 'choice';
    }

    /**
     * set Choices
     *
     * @param array $choices
     *
     * @return self
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;

        return $this;
    }
}
