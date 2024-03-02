<?php
/**
 * Copyright © Robert Konopka All rights reserved.
 *
 */
declare(strict_types=1);

namespace Robert\OrderRadio\Controller\Adminhtml\OrderKind;

class Delete extends \Robert\OrderRadio\Controller\Adminhtml\OrderKind
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('orderkind_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create(\Robert\OrderRadio\Model\OrderKind::class);
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Orderkind.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['orderkind_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Orderkind to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

