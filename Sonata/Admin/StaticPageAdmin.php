<?php

namespace FDevs\StaticPageBundle\Sonata\Admin;

use FDevs\RoutingBundle\Model\ParentRoutingInterface;
use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;

class StaticPageAdmin extends Admin
{
    /**
     * {@inheritDoc}
     */
    protected $formOptions = ['cascade_validation' => true];

    /** @var array */
    private $allowedTypes = [];

    /** @var string */
    protected $baseRoutePattern = 'static-page';

    /** @var string */
    private $formType = 'fdevs_static_type';

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('form.label_type', ['translation_domain' => 'FDevsStaticPageBundle'])
                ->add('type', $this->formType, ['label' => false])
            ->end();
    }

    /**
     * set Form Type
     *
     * @param string $formType
     *
     * @return self
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function prePersist($object)
    {
        $this->updateRoutes($object, $object->getType());
    }

    /**
     * {@inheritDoc}
     */
    public function preUpdate($object)
    {
        $this->updateRoutes($object, $object->getType());
    }

    /**
     * @param ParentRoutingInterface $object
     * @param string                 $type
     */
    private function updateRoutes(ParentRoutingInterface $object, $type)
    {
        /** @var \FDevs\RoutingBundle\Doctrine\Mongodb\Route $route */
        $routeList = $object->getRoutes();
        $value = explode('|', $type);
        if (count($value) == 2 && in_array($value[0], $this->allowedTypes)) {
            foreach ($routeList as $route) {
                $default = $route->getDefaults();
                $data = array_diff_key($default, array_flip($this->allowedTypes));
                $data[$value[0]] = $value[1];
                $route->setDefaults($data);
            }
        }
    }

    /**
     * @param array $allowedTypes
     *
     * @return self
     */
    public function setAllowedTypes(array $allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;

        return $this;
    }
}
