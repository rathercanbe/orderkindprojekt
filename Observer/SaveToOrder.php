<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Observer;

class SaveToOrder implements \Magento\Framework\Event\ObserverInterface
{
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $event = $observer->getEvent();
        $quote = $event->getQuote();
        $order = $event->getOrder();
        $order->setData('order_kind', $quote->getData('quote_kind'));
    }
}
