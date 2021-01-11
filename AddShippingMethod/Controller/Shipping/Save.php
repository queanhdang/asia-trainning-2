<?php
namespace AHT\AddShippingMethod\Controller\Shipping;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action {

    /**
     * Undocumented variable
     *
     * @var [type]
     */
    protected $request;
    /**
     * 
     */
    protected $_logger;

    protected $resource;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Context $context,
        array $data = []
    ){
        $this->_logger = $logger;
        parent::__construct($context,$data);
    }
    public function execute() {
        $data = $this->getRequest()->getParam('price');
        $this->_logger->debug($data);
        $resultJson = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        return $resultJson;

    }
}