<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecentura\LookBook\Controller\Adminhtml\Image;

use Magento\Framework\App\Action\HttpPostActionInterface;

/**
 * Class Delete
 * @package Ecentura\LookBook\Controller\Adminhtml\Index
 */
class Delete extends \Ecentura\LookBook\Controller\Adminhtml\Lookbook implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Ecentura_LookBook::save';
    /**
     * @return ResponseInterface|Redirect|ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */

        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('image_id');

        if ($id) {
            try {

                // init model and delete
                $model = $this->_objectManager->create(\Ecentura\LookBook\Model\Image::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the image.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['image_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Image to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/index');
    }
}
