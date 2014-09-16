<?php

namespace FDevs\StaticPageBundle\Model;

use FDevs\MenuBundle\Model\MenuReferrersInterface;
use FDevs\MenuBundle\Model\MenuReferrersTrait;
use FDevs\PageBundle\Model\Page;
use FDevs\PageBundle\Model\PublishableTrait;
use FDevs\PageBundle\Model\PublishTimePeriodTrait;
use FDevs\RoutingBundle\Model\ParentRoutingInterface;
use FDevs\RoutingBundle\Model\ParentRoutingTrait;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishableInterface;
use Symfony\Cmf\Bundle\CoreBundle\PublishWorkflow\PublishTimePeriodInterface;

class StaticPage extends Page implements PublishableInterface, PublishTimePeriodInterface, ParentRoutingInterface, MenuReferrersInterface
{
    use PublishableTrait;
    use PublishTimePeriodTrait;
    use ParentRoutingTrait;
    use MenuReferrersTrait;
    /**
     * @var \MongoId
     */
    protected $id;
    /**
     * @var string
     */
    protected $type;

    /**
     * @return \MongoId
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
}
