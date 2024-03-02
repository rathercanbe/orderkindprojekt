<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Plugin\Magento\Checkout\Block\Checkout;

use Robert\OrderRadio\Model\ResourceModel\OrderKind\Collection as OrderKindCollection;

class LayoutProcessor
{
    private $orderKindCollection;

    /**
     *  construct method
     *
     * @param OrderKindCollection $orderKindCollection
     */
    public function __construct(
        OrderKindCollection $orderKindCollection
    )
    {
        $this->orderKindCollection = $orderKindCollection;
    }

    /**
     * process function after plugin
     *
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param $jsLayout
     *
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        $jsLayout
    ) {
        $orderKind = $this->orderKindCollection;

        $options = array();

        foreach ($orderKind as $kind) {
            $options[] = [
                'value' => $kind->getData('orderkind_id'),
                'label' => $kind->getData('name')
            ];
        }

        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']['children']['quote_kind'] = [
            'component' => 'Magento_Ui/js/form/element/checkbox-set',
            'config' => [
                'customScope' => 'shippingAddress.quote_kind',
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/checkbox-set',
                'id' => 'quote_kind',
            ],
            'dataScope' => 'shippingAddress.quote_kind',
            'label' => 'Rodzaj zamówienia',
            'provider' => 'checkoutProvider',
            'visible' => true,
            'validation' => [],
            'sortOrder' => 1,
            'id' => 'quote_kind',
            'options' => $options
        ];

        return $jsLayout;
    }
}

