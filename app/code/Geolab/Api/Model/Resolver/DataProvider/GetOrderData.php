<?php


namespace Geolab\Api\Model\Resolver\DataProvider;

use \Magento\Sales\Model\Order;
use \Magento\Quote\Model\QuoteFactory;
use \Magento\Quote\Model\QuoteIdMaskFactory;

class GetOrderData
{

    /**
     * @var Order
     */
    private $order;
    /**
     * @var QuoteFactory
     */
    private $quoteFactory;
    /**
     * @var QuoteIdMaskFactory
     */
    private $quoteIdMaskFactory;

    public function __construct(
        Order $order,
        QuoteFactory $quoteFactory,
        QuoteIdMaskFactory $quoteIdMaskFactory
    )
    {
        $this->order = $order;
        $this->quoteFactory = $quoteFactory;
        $this->quoteIdMaskFactory = $quoteIdMaskFactory;
    }

    public function getData($maskedId) {

        $quoteIdMask = $this->quoteIdMaskFactory->create()->load($maskedId, 'masked_id');
        $quoteId = $quoteIdMask->getQuoteId();

        $quote = $this->quoteFactory->create()->load($quoteId);
        $orderNumber = $quote->getReservedOrderId();

        $items = [];

        foreach ($quote->getAllItems() as $item) {
            $items[] = [
                'id' => $item->getId(),
                'name' => $item->getName(),
                'sku' => $item->getSku(),
                'price' => $item->getPrice(),
                'quantity' => $item->getQty()
            ];
        }

        return [
            'orderNumber' => $orderNumber,
            'order_date' => $quote->getCreatedAt(),
            'items' => $items
        ];
    }

}
