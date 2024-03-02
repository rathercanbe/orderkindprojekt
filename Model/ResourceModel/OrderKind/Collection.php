<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Model\ResourceModel\OrderKind;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'orderkind_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            \Robert\OrderRadio\Model\OrderKind::class,
            \Robert\OrderRadio\Model\ResourceModel\OrderKind::class
        );
    }
}

