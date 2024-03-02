<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Block\Adminhtml\Order\View;

use Magento\Backend\Block\Template\Context;
use Magento\Sales\Helper\Admin as AdminHelper;
use Robert\OrderRadio\Model\ResourceModel\OrderKind\Collection as OrderKindCollection;
use Magento\Framework\Registry;

class View extends \Magento\Sales\Block\Adminhtml\Order\AbstractOrder
{

    /**
     * OrderKindCollection
     *
     * @var OrderKindCollection
     */
    private $orderKindCollection;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param AdminHelper $adminHelper
     * @param OrderKindCollection $orderKindCollection
     */
    public function __construct(
        Context             $context,
        Registry            $registry,
        AdminHelper         $adminHelper,
        OrderKindCollection $orderKindCollection,
        array               $data = []
    )
    {
        parent::__construct($context, $registry, $adminHelper, $data);
        $this->orderKindCollection = $orderKindCollection;
    }

    /**
     * get Label
     *
     */
    public function getLabel()
    {
        $orderKind = $this->orderKindCollection;

        foreach ($orderKind as $kind) {

            if($kind->getData('orderkind_id') == $this->getOrder()->getData('order_kind')) {
                return $kind->getData('name');
            }
        }

        return null;
    }
}
