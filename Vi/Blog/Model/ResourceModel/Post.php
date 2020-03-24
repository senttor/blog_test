<?php

namespace Vi\Blog\Model\ResourceModel;

use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Post extends AbstractDb
{
    /**
     * Post Abstract Resource Constructor
     * @return void
     */
    protected function _construct()
    {
        // к какой таблице подключится и какой ключ использовать
        $this->_init('vi_blog_post', 'post_id');
    }
}
