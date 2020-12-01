<?php

namespace Example\Notice\Block\Index;
use MageDirect\Faq\Api\FaqRepositoryInterface;

class Info extends \Magento\Framework\View\Element\Template
{

    protected $customerSession;
    protected $faqRepository;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        FaqRepositoryInterface $faqRepository,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->faqRepository = $faqRepository;

        parent::__construct($context, $data);
    }

    public function getInfo(){

        $id = $this->getRequest()->getParam('id');
        return $id?$this->faqRepository->getById($id):'';
    }

}
