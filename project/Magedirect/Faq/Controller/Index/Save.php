<?php	
namespace Magedirect\Faq\Controller\Index;

use MageDirect\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;

use MageDirect\Faq\Api\Data\FaqInterface;

class Save extends \Magento\Framework\App\Action\Action	
{	
    protected $resultPageFactory;	
    protected $customerSession;	
    protected $faqRepository;
    protected $searchCriteriaBuilder;
    protected $faqFactory;

    public function __construct(	
        \Magento\Framework\App\Action\Context $context,	
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,	
        \Magento\Customer\Model\Session $customerSession,
        FaqRepositoryInterface $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FaqInterface $faqFactory
    ) {	
        $this->resultPageFactory = $resultPageFactory;	
        $this->customerSession = $customerSession;	
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->faqFactory = $faqFactory;
        parent::__construct($context);	
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()	
    {

        $faq = $this->faqFactory;
        if($id = $this->getRequest()->getParam('faq_id')){
            $faq->setId($id);
        }
        if($title = $this->getRequest()->getParam('title')){
            $faq->setTitle($title);
        }
        if($content = $this->getRequest()->getParam('content')){
            $faq->setContent($content);
        }
        if($is_active = $this->getRequest()->getParam('is_active')){
            $faq->setIsActive($is_active);
        }
        $res = $this->faqRepository->save($faq);
        if($res){	
            $this->_redirect('faq/index/index');
        }	
    }	
}	
