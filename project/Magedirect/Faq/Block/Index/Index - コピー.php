<?php

namespace Magedirect\Faq\Block\Index;

use MageDirect\Faq\Api\FaqRepositoryInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use MageDirect\Faq\Api\Data\FaqInterface;
use Magento\Framework\Api\FilterBuilder;

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
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->faqRepository = $faqRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->faqFactory = $faqFactory;
        $this->filterBuilder = $filterBuilder;



        /*$this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->filterBuilder = $this->objectManager->getObject(\Magento\Framework\Api\FilterBuilder::class);
        $filterGroupBuilder = $this->objectManager->getObject(\Magento\Framework\Api\Search\FilterGroupBuilder::class);

        // @var \Magento\Framework\Api\SearchCriteriaBuilder $searchBuilder
        $this->searchCriteriaBuilder = $this->objectManager->getObject(
            \Magento\Framework\Api\SearchCriteriaBuilder::class,
            ['filterGroupBuilder' => $filterGroupBuilder]
        );
        $this->sortOrderBuilder = $this->objectManager->getObject(
            \Magento\Framework\Api\SortOrderBuilder::class
        );
        $this->groupRepositoryMock = $this->getMockBuilder(\Magento\Customer\Api\GroupRepositoryInterface::class)->getMock();

        $this->searchResults = $this->getMockForAbstractClass(
            \Magento\Framework\Api\SearchResultsInterface::class,
            ['getTotalCount', 'getItems']
        );*/

        /*$this->searchResults
            ->expects($this->any())
            ->method('getTotalCount');
        $this->searchResults
            ->expects($this->any())
            ->method('getItems')
            ->willReturn($this->returnValue([]));

        $this->serviceCollection = $this->objectManager
            ->getObject(
                \Magento\Customer\Model\ResourceModel\Group\Grid\ServiceCollection::class,
                [
                    'filterBuilder' => $this->filterBuilder,
                    'searchCriteriaBuilder' => $this->searchCriteriaBuilder,
                    'groupRepository' => $this->groupRepositoryMock,
                    'sortOrderBuilder' => $this->sortOrderBuilder,
                ]
            );*/


        parent::__construct($context, $data);
    }

    /**
     * @return mixed
     */
    public function getList(){

        /*$filters= $this->filterBuilder
            ->setField(FaqInterface::TITLE)
            ->setConditionType('neq')
            ->setValue("aaaa")
            ->create();
        $this->searchCriteriaBuilder->addFilter($filters);

        $this->searchCriteriaBuilder->setPageSize(4);
        $this->searchCriteriaBuilder->setCurrentPage(1);*/

        $faq = $this->faqFactory;
        $faq->setTitle("aaaa");

        $object = $this->faqRepository->getList($this->searchCriteriaBuilder->create(),$faq);
        $array = $this->object_array($object);
        return $array;

        /* $filters= $this->filterBuilder
            ->setField(FaqInterface::TITLE)
            ->setConditionType('neq')
            ->setValue("aaaa")
            ->create();
        $this->searchCriteriaBuilder->addFilter($filters);

        $sortOrder = $this->sortOrderBuilder
            ->setField(FaqInterface::ID)
            ->setDirection(SortOrder::SORT_ASC)
            ->create();

        $this->searchCriteriaBuilder->setPageSize(4);
        $this->searchCriteriaBuilder->setCurrentPage(false);
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);*/
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
