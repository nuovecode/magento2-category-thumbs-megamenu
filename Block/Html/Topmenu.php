<?php
/**
 * Module Musetti Megamenu
 */
namespace Bitbull\MusettiMenu\Block\Html;

//use Magento\Framework\Data\Tree\Node;
use Magento\Framework\DataObject;
//use Magento\Framework\View\Element\Template;

class Topmenu extends \Magento\Theme\Block\Html\Topmenu
{

    /**
     *
     * @param \Magento\Framework\Data\Tree\Node $child
     * @param string $childLevel
     * @param string $childrenWrapClass
     * @param int $limit
     * @return string
     */

    protected function _addSubMenu(
        $child,
        $childLevel,
        $childrenWrapClass,
        $limit
    ) {

        $html = '';

        if ($childLevel < 1) {

            $html .= '<ul class="level' . $childLevel . ' submenu">';
            $html .= $this->_getHtml($child, $childrenWrapClass, $limit);
            $html .= '</ul>';

        }

        if ($childLevel == 1) {

            $transportObject = new DataObject(['html' => $html]);

            $this->_eventManager->dispatch(
                'vendor_topmenu_node_gethtml_after', [
                    'transport' => $transportObject,
                    'node' => $child->getId()
                ]
            );

            $html = $transportObject->getHtml();
        }

        return $html;

    }

    /**
     * @return string
     */

    protected function _toHtml()
    {
        $this->setModuleName($this->extractModuleName('Magento\Theme\Block\Html\Topmenu'));
        return parent::_toHtml();
    }


}