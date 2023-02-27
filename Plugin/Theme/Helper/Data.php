<?php

namespace Limely\ImageEngine\Plugin\Theme\Helper;

use Limely\ImageEngine\Helper\Data as Helper;

class Data {

    /**
     * Helper
     *
     * @var Helper
     */
    protected $helper;

    /**
     * Store manager
     *
     * @var StoreManager
     */
    protected $storeManager;

    /**
     * Constructor - inject dependencies
     * 
     * @param Helper $helper
     * @param StoreManager $storeManager
     */
    public function __construct(
        Helper $helper,
        StoreManager $storeManager
    ) {
        $this->helper = $helper;
        $this->storeManager = $storeManager;
    }

    /**
     * After get image url
     * 
     * @param mixed $subject
     * @param string $return
     * @return string
     */
    public function afterGetImageUrl($subject, $return) {
        if ($this->helper->isEnabled() && $return) {
            $store = $this->storeManager->getStore();
            if ($store && $this->isImage($return)) {
                $return = str_replace(rtrim($store->getBaseUrl(), '/'), $this->helper->getEngineUrl(), $return);
            }
        }
        return $return;
    }

    /**
     * Is image?
     * 
     * @param string $url
     * @return boolean
     */
    protected function isImage($url) {
        return in_array(pathinfo($url, PATHINFO_EXTENSION), array('gif', 'jpg', 'png', 'webp', 'svg'));
    }

}
