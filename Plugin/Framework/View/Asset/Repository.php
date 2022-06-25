<?php

namespace Limely\ImageEngine\Plugin\Framework\View\Asset;

use Limely\ImageEngine\Helper\Data;
use Magento\Store\Model\StoreManager;
use Magento\Framework\View\Asset\Repository as BaseRepository;

class Repository {

    /**
     * Helper
     * 
     * @var Data
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
     * @param Data $helper
     * @param StoreManager $storeManager
     */
    public function __construct(
        Data $helper,
        StoreManager $storeManager
    ) {
        $this->helper = $helper;
        $this->storeManager = $storeManager;
    }

    /**
     * After get static url
     * 
     * @param BaseRepository $repository
     * @param string $return
     * @return string
     */
    public function afterGetUrlWithParams(BaseRepository $repository, $return) {
        if ($this->helper->isEnabled()) {
            $store = $this->storeManager->getStore();
            if ($store && $this->isImage($return)) {
                $return = str_replace($store->getBaseUrl(), $this->helper->getEngineUrl(), $return);
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
