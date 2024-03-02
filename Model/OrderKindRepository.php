<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\ExtensibleDataObjectConverter;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Store\Model\StoreManagerInterface;
use Robert\OrderRadio\Api\Data\OrderKindInterfaceFactory;
use Robert\OrderRadio\Api\Data\OrderKindSearchResultsInterfaceFactory;
use Robert\OrderRadio\Api\OrderKindRepositoryInterface;
use Robert\OrderRadio\Model\ResourceModel\OrderKind as ResourceOrderKind;
use Robert\OrderRadio\Model\ResourceModel\OrderKind\CollectionFactory as OrderKindCollectionFactory;

class OrderKindRepository implements OrderKindRepositoryInterface
{

    protected $resource;

    protected $orderKindFactory;

    protected $orderKindCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataOrderKindFactory;

    protected $extensionAttributesJoinProcessor;

    private $storeManager;

    private $collectionProcessor;

    protected $extensibleDataObjectConverter;

    /**
     * @param ResourceOrderKind $resource
     * @param OrderKindFactory $orderKindFactory
     * @param OrderKindInterfaceFactory $dataOrderKindFactory
     * @param OrderKindCollectionFactory $orderKindCollectionFactory
     * @param OrderKindSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     * @param CollectionProcessorInterface $collectionProcessor
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     * @param ExtensibleDataObjectConverter $extensibleDataObjectConverter
     */
    public function __construct(
        ResourceOrderKind $resource,
        OrderKindFactory $orderKindFactory,
        OrderKindInterfaceFactory $dataOrderKindFactory,
        OrderKindCollectionFactory $orderKindCollectionFactory,
        OrderKindSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager,
        CollectionProcessorInterface $collectionProcessor,
        JoinProcessorInterface $extensionAttributesJoinProcessor,
        ExtensibleDataObjectConverter $extensibleDataObjectConverter
    ) {
        $this->resource = $resource;
        $this->orderKindFactory = $orderKindFactory;
        $this->orderKindCollectionFactory = $orderKindCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataOrderKindFactory = $dataOrderKindFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
        $this->collectionProcessor = $collectionProcessor;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
        $this->extensibleDataObjectConverter = $extensibleDataObjectConverter;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
    ) {
        /* if (empty($orderKind->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $orderKind->setStoreId($storeId);
        } */

        $orderKindData = $this->extensibleDataObjectConverter->toNestedArray(
            $orderKind,
            [],
            \Robert\OrderRadio\Api\Data\OrderKindInterface::class
        );

        $orderKindModel = $this->orderKindFactory->create()->setData($orderKindData);

        try {
            $this->resource->save($orderKindModel);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the orderKind: %1',
                $exception->getMessage()
            ));
        }
        return $orderKindModel->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function get($orderKindId)
    {
        $orderKind = $this->orderKindFactory->create();
        $this->resource->load($orderKind, $orderKindId);
        if (!$orderKind->getId()) {
            throw new NoSuchEntityException(__('OrderKind with id "%1" does not exist.', $orderKindId));
        }
        return $orderKind->getDataModel();
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->orderKindCollectionFactory->create();

        $this->extensionAttributesJoinProcessor->process(
            $collection,
            \Robert\OrderRadio\Api\Data\OrderKindInterface::class
        );

        $this->collectionProcessor->process($criteria, $collection);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $items = [];
        foreach ($collection as $model) {
            $items[] = $model->getDataModel();
        }

        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
    ) {
        try {
            $orderKindModel = $this->orderKindFactory->create();
            $this->resource->load($orderKindModel, $orderKind->getOrderkindId());
            $this->resource->delete($orderKindModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the OrderKind: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($orderKindId)
    {
        return $this->delete($this->get($orderKindId));
    }
}

