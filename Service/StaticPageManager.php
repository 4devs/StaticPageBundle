<?php

namespace FDevs\StaticPageBundle\Service;

use FDevs\PageBundle\Service\PageManager;

class StaticPageManager extends PageManager
{
    private $pages = [];

    public function setTypes(array $pages = [])
    {
        $this->pages = $pages;

        return $this;
    }

    public function getTypeByName($name, $asArray = true)
    {
        $data = isset($this->pages[$name]) ? $this->pages[$name] : [];

        return $asArray ? $data : implode('|', $data);
    }

    public function getChoices()
    {
        return self::prepareChoices($this->pages);
    }

    public static function prepareChoices(array $data = [])
    {
        return array_flip(
            array_map(
                function ($val) {
                    return implode('|', $val);
                },
                $data
            )
        );
    }
}
