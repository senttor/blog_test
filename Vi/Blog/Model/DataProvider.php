<?php
namespace Vi\Blog\Model;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Registry;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Vi\Blog\Model\ResourceModel\Post\CollectionFactory;

class DataProvider extends AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        Registry $registry,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $postCollectionFactory->create();
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = [];
        /** @var Customer $customer */
        foreach ($items as $post) {
            $this->loadedData[$post->getId()] = $post->getData();
        }

        return $this->loadedData;
    }
}
