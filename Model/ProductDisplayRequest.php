<?php
declare(strict_types=1);

namespace Denal05\Ad0e702ExerciseFrontendControllerMVVM\Model;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Exception\NotFoundException;

class ProductDisplayRequest
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
    )
    {
        $this->request = $request;
        $this->productRepository = $productRepository;
    }

    public function getProduct(): ProductInterface
    {
        if (!$this->product) {
            $id = (int)$this->request->getParam('id');
            if (!$id) {
                throw new NotFoundException(__('No product was
specified.'));
            }
            $this->product = $this->productRepository->getById($id);
        }
        return $this->product;
    }
}
