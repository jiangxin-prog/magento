<?php
namespace Magedirect\Faq\Model\ResourceModel\Faq;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'faq_id';

    protected function _construct()
    {
        $this->_init(\Magedirect\Faq\Model\Faq::class, 'Magedirect\Faq\Model\ResourceModel\Faq');
    }
}