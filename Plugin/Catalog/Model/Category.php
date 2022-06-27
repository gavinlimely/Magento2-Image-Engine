<?php

namespace Limely\ImageEngine\Plugin\Catalog\Model;

use Limely\ImageEngine\Helper\Data;
use Magento\Catalog\Model\Category as BaseCategory;

class Category {

    /**
     * Helper
     * 
     * @var Data
     */
    protected $helper;

    /**
     * Constructor - inject dependencies
     * 
     * @param Data $helper
     */
    public function __construct(Data $helper) {
        $this->helper = $helper;
    }

    /**
     * After get static url
     * 
     * @param BaseCategory $category
     * @param string $return
     * @return string
     */
    public function afterGetImageUrl(BaseCategory $category, $return) {
        if ($this->helper->isEnabled()) {
            if (substr($return, 0, 1) === '/') {
                $return = $this->helper->getEngineUrl() . '/' . ltrim($return, '/');
            }
        }
        return $return;
    }

}
