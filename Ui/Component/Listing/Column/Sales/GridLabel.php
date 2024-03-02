<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Ui\Component\Listing\Column\Sales;


use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class GridLabel extends \Magento\Ui\Component\Listing\Columns\Column
{
    protected $orderKindRepository;

    /**
     * @param \Robert\OrderRadio\Model\OrderKindRepository $orderKindRepository
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Robert\OrderRadio\Model\OrderKindRepository $orderKindRepository,
        array $components = [],
        array $data = []
    ){
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->orderKindRepository = $orderKindRepository;
    }

    /**
     * Prepare Data Source.
     *
     * @param array $dataSource
     *
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                try {
                    if ($orderKind = $this->orderKindRepository->get($item['order_kind'])) {
                        $item['order_kind'] = $orderKind->getName();
                    }
                } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                    $item['order_kind'] = __('Nie ustawione');
                }
            }
        }

        return $dataSource;
    }
}
