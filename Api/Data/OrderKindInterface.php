<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Api\Data;

interface OrderKindInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const NAME = 'name';
    const ORDERKIND_ID = 'orderkind_id';

    /**
     * Get orderkind_id
     * @return string|null
     */
    public function getOrderkindId();

    /**
     * Set orderkind_id
     * @param string $orderkindId
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     */
    public function setOrderkindId($orderkindId);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     */
    public function setName($name);

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     * @param \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface $extensionAttributes
    );
}

