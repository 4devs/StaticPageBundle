<?php

namespace FDevs\StaticPageBundle\Tests\Service;

use FDevs\StaticPageBundle\Service\StaticPageManager;
use FDevs\StaticPageBundle\Tests\TestCase;

class StaticPageManagerTest extends TestCase
{
    public function testParent()
    {
        $this->assertInstanceOf('\FDevs\PageBundle\Service\PageManager', new StaticPageManager(''));
    }
} 