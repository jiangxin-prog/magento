<?php

namespace MageDirect\Faq\Model\ResourceModel;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Faq extends AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Notice Abstract Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magedirect_faq', 'faq_id');
    }

}