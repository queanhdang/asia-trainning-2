<?php 
namespace AHT\AddAttributeOrder\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveCustomFieldToOrder implements ObserverInterface
{
    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    /**
     * 
     */
    protected $_quoteRepository;
    /**
     * @param \Magento\Framework\ObjectManagerInterface $objectmanager
     */
    protected $_logger;
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectmanager,
        \Magento\Quote\Model\QuoteRepository $quoteRepository,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_objectManager = $objectmanager;
        $this->_quoteRepository = $quoteRepository;
        $this->_logger = $logger;
    }

    /**
     * Luuw thong tin order_by field sau khi an place order
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order = $observer->getOrder();
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->_quoteRepository->get($order->getQuoteId());
        $this->_logger->debug('hehe');
        $order->setOrderBy( $quote->getOrderBy() );
        return $this;
    }
}

