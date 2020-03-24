<?php

namespace Vi\Blog\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Vi\Blog\Model\ResourceModel\Post\Collection as PostCollection;
use \Vi\Blog\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use \Vi\Blog\Model\Post;

class Posts extends Template
{
    /**
     * CollectionFactory
     * @var null|PostCollectionFactory
     */
    protected $_postCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data = []
    ) {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function getPosts()
    {

        /** @var PostCollection $postCollection */
        try {
            $postCollection = $this->_postCollectionFactory->create();
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }

        $postCollection->addFieldToSelect('*')->load();
        return $postCollection->getItems();
    }

    /**
     * For a given post, returns its url
     * @param Post $post
     * @return string
     */
    public function getPostUrl(
        Post $post
    ) {
        return '/blog/post/view/id/' . $post->getId();
    }
}
