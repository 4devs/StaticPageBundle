<?php

namespace FDevs\StaticPageBundle\Form\Type;

use FDevs\StaticPageBundle\Service\StaticPageManager;
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
        $resolver->setDefaults(['choices' => StaticPageManager::prepareChoices($this->choices)]);
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
