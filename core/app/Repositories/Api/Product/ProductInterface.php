<?php

namespace App\Repositories\Api\Product;

interface ProductInterface
{
    public function getProductList();
    public function getVariantList($id);
    public function getVariantImg($id);
    public function getStockSearchList($request);
    public function getUnboxList($request);
    public function getUnbox($request);
}
