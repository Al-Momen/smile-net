<?php 
namespace App\Traits;

trait CommonTrait {

    public function getVariantNo($request)
    {

        $product_variant_arr = [];

        $query  = $request->all();
        $result = array_intersect_key($query, array_flip(preg_grep("/^product_no_/", array_keys($query))));
        if(!empty($result)){
            $product_nos = implode(',', $result);
            $product_variant_arr = explode(',', $product_nos); 
        }
        
        return $product_variant_arr;
    }




}