<?php

namespace AHT\AddAttributeOrder\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    protected $orderRepository;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ){
        $this->orderRepository = $orderRepository;
        parent::__construct($context);
    }
    
    public function getOrderById($id)
    {
        return $this->orderRepository->get($id);
    }
}