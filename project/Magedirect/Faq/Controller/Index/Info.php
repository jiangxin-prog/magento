<?php
namespace Magedirect\Faq\Controller\Index;

use MageDirect\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

class Info extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    protected $customerSession;
    protected $faqRepository;
    protected $searchCriteriaBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Customer\Model\Session $customerSession,
        FaqRepositoryInterface $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->customerSession = $customerSession;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {



        //$filters[] = $this->filterBuilder->setConditionType('like')->setField(FaqInterface::TITLE)->setValue('11%')->create();

        // $this->searchCriteriaBuilder->addFilters($filters);

        /* $this->searchCriteriaBuilder->setPageSize(4);
         $this->searchCriteriaBuilder->setCurrentPage(1);

         $faqs = $this->faqRepository->getList($this->searchCriteriaBuilder->create());

         echo 111;exit;*/


        $page = $this->resultPageFactory->create();
        $page->setHeader('Cache-Control','no-store,?no-cache,?must-revalidate,?max-age=0',true);
        return $page;

    }
}	
