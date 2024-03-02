<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Api\Data;

interface OrderKindSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get OrderKind list.
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface[]
     */
    public function getItems();

    /**
     * Set name list.
     * @param \Robert\OrderRadio\Api\Data\OrderKindInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

