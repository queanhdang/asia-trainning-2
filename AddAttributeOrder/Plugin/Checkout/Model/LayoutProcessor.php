<?php
 
namespace AHT\AddAttributeOrder\Plugin\Checkout\Model;
 
use Magento\Checkout\Block\Checkout\LayoutProcessor as ChekcoutLayerprocessor;
/**
 * Tao them 1 o input Orderby ngoai frontend 
 */
class LayoutProcessor
{
    
 
    public function afterProcess(ChekcoutLayerprocessor $subject, array $jsLayout)
    {
 
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['order_by'] = [
            'component' => 'Magento_Ui/js/form/element/abstract',
            'config' => [
                'customScope' => 'shippingAddress',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/input',
                'options' => [],
                'id' => 'order_by'
            ],
            'dataScope' => 'shippingAddress.order_by',
            'label' => 'Order By',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 252,
            'id' => 'order_by'
        ];
 
        return $jsLayout;
    }
}