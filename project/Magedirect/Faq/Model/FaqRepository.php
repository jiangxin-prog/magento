<?php
namespace MageDirect\Faq\Model;

use MageDirect\Faq\Api\Data\FaqInterface;
use MageDirect\Faq\Api\Data\FaqSearchResultsInterfaceFactory;
use MageDirect\Faq\Api\FaqRepositoryInterface;
use MageDirect\Faq\Model\ResourceModel\Faq as ResourceFaq;
use MageDirect\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

class FaqRepository implements FaqRepositoryInterface
{
    protected $resource;
    protected $faqFactory;
    protected $faqCollectionFactory;
    protected $searchResultsFactory;
    protected $collectionProcessor;
    protected $filterBuilder;
    protected $searchCriteriaInterface;
    protected $extensionAttributesJoinProcessor;
    protected $instances = [];

    public function __construct(
        ResourceFaq $resource,
        FaqFactory $faqFactory,
        FaqCollectionFactory $faqCollectionFactory,
        FaqSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor,
        FilterBuilder $filterBuilder,
        SearchCriteriaInterface $searchCriteriaInterface,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    )
    {
        $this->resource = $resource;
        $this->faqFactory = $faqFactory;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->filterBuilder = $filterBuilder;
        $this->searchCriteriaInterface = $searchCriteriaInterface;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }

    /**
     * @param \MageDirect\Faq\Api\Data\FaqInterface $faq
     * @return \MageDirect\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(FaqInterface $faq){


        try{
            $this->resource->save($faq);
        }catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        unset($this->instances[$faq->getId()]);
        return $faq;
    }

    /**
     * @param int $faqId
     * @return FaqInterface
     * @throws NoSuchEntityException
     */
    public function getById($faqId){
        if(!isset($this->instances[$faqId])){
            $faq = $this->faqFactory->create();
            $this->resource->load($faq, $faqId);
            if (!$faq->getId()) {
                throw new NoSuchEntityException(__('Faq with id "%1" does not exist.', $faqId));
            }
            $this->instances[$faqId] = $faq;
        }
        return $this->instances[$faqId];
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @param object $faq
     * @return FaqSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria,$faq=null){

        $collection = $this->faqCollectionFactory->create();
        $this->extensionAttributesJoinProcessor->process($collection, FaqInterface::class);
        $collection->addFieldToSelect("faq_id");
        $collection->addFieldToSelect("title");
        $collection->addFieldToSelect("content");
        $collection->addFieldToSelect("is_active");
        $collection->join('active_faq','active_faq.actice_id=main_table.faq_id',['actice_id','name']);

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        $searchResultsss = $searchResults;
        return $searchResultsss;exit;
    }

    /**
     * @param FaqInterface $faq
     * @return bool true on success
     * @throws CouldNotDeleteException
     */
    public function delete(FaqInterface $faq){
        try{
            $faqId = $faq->getId();
            $this->resource->delete($faq);
        }catch (\Exception $exception){
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }
        unset($this->instances[$faqId]);
        return true;
    }

    /**
     * @param int $faqId
     * @return bool true on success
     */
    public function deleteById($faqId){
        return $this->delete($this->getById($faqId));
    }
}

