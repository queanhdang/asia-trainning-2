<?php
namespace AHT\AddShippingMethod\Model\Carrier;

use Magento\Shipping\Model\Rate\Result;

class DQAShipping extends \Magento\Shipping\Model\Carrier\AbstractCarrier implements \Magento\Shipping\Model\Carrier\CarrierInterface 
{
    protected $_code = 'dqa_shipping';
    /*
    @var \Magento\Shipping\Model\Rate\ResultFactory
    */
    protected $_rateResultFactory;
    /*
    @var \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory
    */
    protected $_rateMethodFactory;
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory $rateErrorFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Shipping\Model\Rate\ResultFactory $rateResultFactory,
        \Magento\Quote\Model\Quote\Address\RateResult\MethodFactory $rateMethodFactory,
        array $data = []
    ) {
        $this->_rateResultFactory = $rateResultFactory;
        $this->_rateMethodFactory = $rateMethodFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }
    /**
     * quyet dinh pthuc nao duoc su dung va chi phi van chuyen
     *
     * @param \Magento\Quote\Model\Quote\Address\RateRequest $request
     * @return 
     */
    public function collectRates(\Magento\Quote\Model\Quote\Address\RateRequest $request) {
        if (!$this->getConfigFlag('active')) {
            return false;
        }
        $result = $this->_rateResultFactory->create();
        //Check if express method is enabled
        // if ($this->getConfigData('express_enabled')) {
            $method = $this->_rateMethodFactory->create();
            $method->setCarrier($this->_code);
            $method->setCarrierTitle($this->getConfigData('name'));
            $method->setMethod('express');
            $method->setMethodTitle($this->getConfigData('express_title'));
            $method->setPrice($this->getConfigData('express_price'));
            $method->setCost($this->getConfigData('express_price'));
            $result->append($method);
        // }
        return $result;
    }
    /**
     * Them cac phuong thuc van chuyen cua dqashipping vao cac phuong thuc van chuyen duoc phep
     *
     * 
     */
    public function getAllowedMethods() {
        return ['dqa_shipping' => $this->getConfigData('name')];
    }

    public function isTrackingAvailable() {
        return true;
    }
}