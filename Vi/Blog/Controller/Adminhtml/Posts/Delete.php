<?php
namespace Vi\Blog\Controller\Adminhtml\Posts;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Vi\Blog\Api\PostRepositoryInterface;

/**
 * Class Save

 * @package Vi\Blog\Controller\Adminhtml\Posts
 */
class Delete extends Action
{

    /**
     * @var PostRepositoryInterface
     */
    private $postRepository;

    /**
     * Delete constructor.
     *
     * @param Context $context
     * @param PostRepositoryInterface $postRepository
     */
    public function __construct(Context $context, PostRepositoryInterface $postRepository)
    {
        parent::__construct($context);
        $this->postRepository = $postRepository;
    }

    /**
     * Dispatch request
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($id = $this->getRequest()->getParam('post_id')) {
            try {
                $this->postRepository->deleteById($id);

                $this->messageManager->addSuccess(__('You deleted the posts successfully.'));

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {

                $this->messageManager->addErrorMessage($e->getMessage());

                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a post to delete.'));

        return $resultRedirect->setPath('*/*/');
    }
}
