<?php

namespace Magedirect\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for product search results.
 * @api
 */
interface FaqSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get products list.
     *
     * @return \Magedirect\Faq\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * Set products list.
     *
     * @param \Magedirect\Faq\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
