<?php

namespace Limely\ImageEngine\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\App\State;

class Data extends AbstractHelper {

    /**
     * State
     * 
     * @var State
     */
    protected $state;

    /**
     * Constructor - inject dependencies
     * 
     * @param Context $context
     * @param State $state
     */
    public function __construct(
        Context $context,
        State $state
    ) {
        parent::__construct($context);
        $this->state = $state;
    }
    
    /**
     * Is enabled check
     * 
     * @return boolean
     */
    public function isEnabled() {
        try {
            if ($this->state->getAreaCode() === \Magento\Framework\App\Area::AREA_ADMINHTML) {
                throw new \Exception('Admin area.');
            }
        } catch (\Exception $e) {
            return false;
        }
        return !!($this->getEnabled() && $this->getEngineUrl());
    }

    /**
     * Get engine URL
     * 
     * @return string
     */
    public function getEngineUrl() {
        $url = $this->scopeConfig->getValue('image_engine/settings/engine_url', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
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
        return $this->scopeConfig->getValue('image_engine/settings/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
