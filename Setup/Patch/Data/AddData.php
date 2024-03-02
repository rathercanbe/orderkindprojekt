<?php

namespace Robert\OrderRadio\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

class AddData implements DataPatchInterface
{
    private $orderKindFactory;

    /**
     * construct method
     *
     * @param \Robert\OrderRadio\Model\OrderKindFactory $orderKindFactory
     */
    public function __construct(
        \Robert\OrderRadio\Model\OrderKindFactory $orderKindFactory
    ) {
        $this->orderKindFactory = $orderKindFactory;
    }

    /**
     * apply data to OrderKind Model
     */
    public function apply()
    {
        $sampleData = [
            [
                'name' => 'Standardowe'
            ],
            [
                'name' => 'Ekspozycyjne'
            ],
            [
                'name' => 'Testowe'
            ]
        ];
        foreach ($sampleData as $data) {
            $this->orderKindFactory->create()->setData($data)->save();
        }
    }

    /**
     * get dependencies
     *
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * get aliases
     *
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

}
