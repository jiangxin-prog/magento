<?php

namespace Magedirect\Faq\Block\Index;

use MageDirect\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use MageDirect\Faq\Api\Data\FaqInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\SortOrderBuilder;
class Index extends \Magento\Framework\View\Element\Template
{

    protected $customerSession;
    protected $faqRepository;
    protected $searchCriteriaBuilder;
    protected $faqFactory;

    protected $objectManager;
    protected $filterBuilder;
    protected $sortOrderBuilder;

    protected $searchResults;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        FaqRepositoryInterface $faqRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FaqInterface $faqFactory,
        FilterBuilder $filterBuilder,
        SortOrderBuilder $sortOrderBuilder,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->faqFactory = $faqFactory;
        $this->filterBuilder = $filterBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;


        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getList(){

        //search
        $filters= $this->filterBuilder
            ->setField(FaqInterface::TITLE)
            ->setConditionType('neq')
            ->setValue("aaaa")
            ->create();
        $this->searchCriteriaBuilder->addFilter($filters);
        //order
        $this->searchCriteriaBuilder->addSortOrder(FaqInterface::FAQ_ID,'desc');
        //page
        $this->searchCriteriaBuilder->setPageSize(4);
        $this->searchCriteriaBuilder->setCurrentPage(1);

        $object = $this->faqRepository->getList($this->searchCriteriaBuilder->create());
        $array = $this->object_array($object);
        return $array;

    }

    /**
     * object change array
     * @param $array
     * @return array
     */
    function object_array($array) {

        if(is_object($array)) {
            $array = (array)$array;
        }
        $array_new = [];
        if(is_array($array)) {
            foreach($array as $key=>$value) {
                $items = $value['items'];
                foreach($items as $ke=> $val) {
                    foreach($val as $k =>$v) {
                        $array_new[] = $v;
                    }
                }
            }
        }
        $array_new = $array_new;
        return $array_new;
    }
    

}
