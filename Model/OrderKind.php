<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Model;

use Magento\Framework\Api\DataObjectHelper;
use Robert\OrderRadio\Api\Data\OrderKindInterface;
use Robert\OrderRadio\Api\Data\OrderKindInterfaceFactory;

class OrderKind extends \Magento\Framework\Model\AbstractModel
{

    protected $orderkindDataFactory;

    protected $dataObjectHelper;

    protected $_eventPrefix = 'robert_orderradio_orderkind';

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param OrderKindInterfaceFactory $orderkindDataFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param \Robert\OrderRadio\Model\ResourceModel\OrderKind $resource
     * @param \Robert\OrderRadio\Model\ResourceModel\OrderKind\Collection $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        OrderKindInterfaceFactory $orderkindDataFactory,
        DataObjectHelper $dataObjectHelper,
        \Robert\OrderRadio\Model\ResourceModel\OrderKind $resource,
        \Robert\OrderRadio\Model\ResourceModel\OrderKind\Collection $resourceCollection,
        array $data = []
    ) {
        $this->orderkindDataFactory = $orderkindDataFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Retrieve orderkind model with orderkind data
     * @return OrderKindInterface
     */
    public function getDataModel()
    {
        $orderkindData = $this->getData();

        $orderkindDataObject = $this->orderkindDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $orderkindDataObject,
            $orderkindData,
            OrderKindInterface::class
        );

        return $orderkindDataObject;
    }
}

