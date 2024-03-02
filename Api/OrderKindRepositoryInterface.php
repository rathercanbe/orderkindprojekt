<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface OrderKindRepositoryInterface
{

    /**
     * Save OrderKind
     * @param \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
    );

    /**
     * Retrieve OrderKind
     * @param string $orderkindId
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($orderkindId);

    /**
     * Retrieve OrderKind matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Robert\OrderRadio\Api\Data\OrderKindSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete OrderKind
     * @param \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Robert\OrderRadio\Api\Data\OrderKindInterface $orderKind
    );

    /**
     * Delete OrderKind by ID
     * @param string $orderkindId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($orderkindId);
}

