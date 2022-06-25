<?php

namespace Limely\ImageEngine\Plugin\Store\Model;

use Limely\ImageEngine\Helper\Data;
use Magento\Store\Model\Store as BaseStore;
use Magento\Framework\UrlInterface;

class Store {

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
     * After get base url
     * 
     * @param BaseStore $store
     * @param string $result
     * @param string $type
     * @return string
     */
    public function afterGetBaseUrl(BaseStore $store, $result, $type) {
        if ($this->helper->isEnabled()) {
            if ($type == UrlInterface::URL_TYPE_MEDIA) {
                $return = str_replace($store->getBaseUrl(), $this->helper->getEngineUrl(), $return);
            }
        }
        return $result;
    }

}
