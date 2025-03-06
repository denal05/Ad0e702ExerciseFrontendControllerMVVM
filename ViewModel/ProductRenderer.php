<?php
declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseFrontendControllerMVVM\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class ProductRenderer implements ArgumentInterface
{
    /** @var RequestInterface */
    private $request;
    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var ProductInterface|null */
    private $product;

    public function __construct(
        RequestInterface           $request,
        ProductRepositoryInterface $productRepository
    ) {
        $this->request = $request;
        $this->productRepository = $productRepository;
    }
    public function getProduct(): ?ProductInterface
    {
        try {
            if (!$this->product) {
                $id = (int)$this->request->getParam('id');
                if (!$id) {
                    throw new NotFoundException(__('No product was specified.'));
                }
                $this->product = $this->productRepository->getById($id);
            }
            return $this->product;
        } catch (NotFoundException $notFoundException) {
            return null; // invalid product ID
        } catch (NoSuchEntityException $noSuchEntityException) {
            return null; // no ID specified in request
        }
    }
}
