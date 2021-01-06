<?php 
namespace AHT\AddAttributeOrder\Plugin\Checkout;

class SaveAddressInformation
{
    protected $quoteRepository;
    protected $logger;
    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->quoteRepository = $quoteRepository;
        $this->logger = $logger;
    }    
    /**
     * Luu thong tin order_by chuyen tiep giua buoc shipping va payment
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    ) {
        $extensionAttributes = $addressInformation->getExtensionAttributes();
        $customField = $extensionAttributes->getOrderBy();
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setOrderBy($customField);
        $this->logger->debug(json_encode($quote->getData()));
    }
}