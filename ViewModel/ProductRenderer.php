<?php
declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseFrontendControllerMVVM\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Denal05\Ad0e702ExerciseFrontendControllerMVVM\Model\ProductDisplayRequest;
class ProductRenderer implements ArgumentInterface
{
    /** @var ProductDisplayRequest */
    private $displayRequest;

    public function __construct(ProductDisplayRequest $displayRequest)
    {
        $this->displayRequest = $displayRequest;
    }
    public function getProduct(): ?ProductInterface
    {
        try {
            return $this->displayRequest->getProduct();
        } catch (NotFoundException $ex) {
            return null; // invalid product ID
        } catch (NoSuchEntityException $ex) {
            return null; // no ID specified in request
        }
    }
}
