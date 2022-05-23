<?php


namespace Geolab\Api\Model\Resolver;

use Geolab\Api\Helper\Data;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Geolab\Api\Model\Resolver\DataProvider\GetOrderData as GetOrderDataProvider;

class GetOrderData implements ResolverInterface
{

    /**
     * @var Data
     */
    private $config;
    /**
     * @var GetOrderDataProvider
     */
    private $orderDataProvider;

    /**
     * GetOrderData constructor.
     * @param Data $config
     * @param DataProvider\GetOrderData $getOrderDataProvider
     */
    public function __construct(
        Data $config,
        GetOrderDataProvider $getOrderDataProvider
    )
    {
        $this->config = $config;
        $this->orderDataProvider = $getOrderDataProvider;

    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {

        if($this->config->getGeneralConfig('enable')) {

            $orderId = $args['orderId'];

            return $this->orderDataProvider->getData($orderId);

        } else {
//            return ['message' => 'ERROR: Module is not enabled'];
        }

    }
}
