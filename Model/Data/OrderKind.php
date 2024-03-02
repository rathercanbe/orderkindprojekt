<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Model\Data;

use Robert\OrderRadio\Api\Data\OrderKindInterface;

class OrderKind extends \Magento\Framework\Api\AbstractExtensibleObject implements OrderKindInterface
{

    /**
     * Get orderkind_id
     * @return string|null
     */
    public function getOrderkindId()
    {
        return $this->_get(self::ORDERKIND_ID);
    }

    /**
     * Set orderkind_id
     * @param string $orderkindId
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     */
    public function setOrderkindId($orderkindId)
    {
        return $this->setData(self::ORDERKIND_ID, $orderkindId);
    }

    /**
     * Get name
     * @return string|null
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \Robert\OrderRadio\Api\Data\OrderKindInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Retrieve existing extension attributes object or create a new one.
     * @return \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object.
     * @param \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \Robert\OrderRadio\Api\Data\OrderKindExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}

