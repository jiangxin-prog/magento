<?php
/**
 * Created by PhpStorm.
 * User: 9006280
 * Date: 2019/11/15
 * Time: 13:49
 */
// app/code/[Vendor]/[Module]/Api/FaqRepositoryInterface.php

namespace MageDirect\Faq\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqRepositoryInterface
{
    /**
     * Save faq
     *
     * @param \MageDirect\Faq\Api\Data\FaqInterface $faq
         * @return \MageDirect\Faq\Api\Data\FaqInterface
         * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\FaqInterface $faq);

    /**
     * Retrieve faq
     *
     * @param int $faqId
     * @return \MageDirect\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */

    public function getById($faqId);

    /**
     *  Retrieve faqs matching the specified criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @param \MageDirect\Faq\Api\Data\FaqInterface $faq
     * @return \MageDirect\Faq\Api\Data\FaqSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria,$faq=null);

    /**
     * Delete faq
     *
     * @param \MageDirect\Faq\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(Data\FaqInterface $faq);

    /**
     * Delete faq by ID
     *
     * @param int $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}