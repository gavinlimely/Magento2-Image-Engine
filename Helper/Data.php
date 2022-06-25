<?php

namespace Limely\ImageEngine\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper {

    /**
     * Is enabled check
     * 
     * @return boolean
     */
    public function isEnabled() {
        return !!($this->getEnabled() && $this->getEngineUrl());
    }

    /**
     * Get engine URL
     * 
     * @return string
     */
    public function getEngineUrl() {
        $url = $this->scopeConfig->getValue('image_engine/settings/engine_url', ScopeInterface::SCOPE_STORE);
        if ($url) {
            return rtrim($url, '/');
        }
    }

    /**
     * Get enabled
     * 
     * @return int
     */
    public function getEnabled() {
        return $this->scopeConfig->getValue('image_engine/settings/enabled', ScopeInterface::SCOPE_STORE);
    }

}
