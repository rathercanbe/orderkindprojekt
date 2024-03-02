<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Model\ResourceModel;

class OrderKind extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('robert_orderradio_orderkind', 'orderkind_id');
    }
}

