<?php
declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseFrontendControllerMVVM\Controller\Welcome;

use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    private PageFactory $pageFactory;
    protected Context $context;

    public function __construct(
        PageFactory $pageFactory,
        Context $context,
    ) {
        $this->pageFactory = $pageFactory;
        $this->context = $context;

        /*
         * According to SwiftOtter's AD0-E702 Study Guide, the controller's constructor must pass the Context to the
         * parent constructor. However, the line below returns an Internal Server Error 500, and PhpStorm complains that
         * "parent" is an undefined class, i.e., it cannot find its declaration.
         */
        ////parent::__constructor($this->context);
    }

    public function execute(): Page
    {
        return $this->pageFactory->create();
    }
}
