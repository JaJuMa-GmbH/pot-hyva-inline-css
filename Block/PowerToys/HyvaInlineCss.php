<?php
/**
 * @author    JaJuMa GmbH <info@jajuma.de>
 * @copyright Copyright (c) 2023 JaJuMa GmbH <https://www.jajuma.de>. All rights reserved.
 * @license   http://opensource.org/licenses/mit-license.php MIT License
 */
namespace Jajuma\PotHyvaInlineCss\Block\PowerToys;
use Jajuma\PowerToys\Block\PowerToys\Dashboard;
use Magento\Framework\View\Element\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\App\State;
use Magento\Framework\App\Area;

class HyvaInlineCss extends Dashboard
{
    const XML_PATH_ENABLE = 'power_toys/hyva_inline_css/is_enabled';

    const XML_PATH_IS_ENABLE_ORIGIN_MODULE = 'hyvainlinecss/general/enabled';

    private $state;

    public function __construct(
        Registry $registry,
        Context $context,
        State $state,
        array $data = []
    ) {
        $this->registry = $registry;
        $this->state = $state;
        parent::__construct($context, $data);
    }

    public function isParentEnable(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_IS_ENABLE_ORIGIN_MODULE);
    }

    public function isEnable(): bool
    {
        return $this->_scopeConfig->isSetFlag(self::XML_PATH_ENABLE) &&
        $this->isFrontend();
    }

    public function isFrontend(): bool
    {
        $areaCode = $this->state->getAreaCode();
        return $areaCode == Area::AREA_FRONTEND;
    }
}
