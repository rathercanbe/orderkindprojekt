<?php
/**
 * Copyright © Robert Konopka. All rights reserved.
 *
 */
namespace Robert\OrderRadio\Observer;

use Magento\Framework\Event\ObserverInterface;
use Robert\OrderRadio\Model\ResourceModel\OrderKind\Collection as OrderKindCollection;

/**
 * Observer for setting foreign key for quote order kind value to quote
 *
 * @SuppressWarnings(PHPMD.CookieAndSessionMisuse)
 */
class SetQuoteConstraint implements ObserverInterface
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
     * Set order kind data into quote
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var $quote \Magento\Quote\Model\Quote */
        $quote = $observer->getEvent()->getQuote();
        if (!$quote) {
            return;
        }

        $orderKind = $this->orderKindCollection;

        $options = array();
        $first_id = null;

        foreach ($orderKind as $kind) {
            $first_id = $kind->getData('orderkind_id');

            break;
        }

        if($quote->getData('quote_kind') == null && $first_id) {
            $quote->setData('quote_kind', $first_id);
        }
    }
}
