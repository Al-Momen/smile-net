<?php
namespace App\Repositories\Api\Product;
use DB;
use App\Models\Box;
use App\Models\Stock;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\AdminUser;
use App\Models\ProdImgLib;
use App\Models\Shipmentbox;
use App\Traits\ApiResponse;
use App\Models\ProductVariant;
use Symfony\Component\HttpFoundation\Request;

class ProductAbstract implements ProductInterface
{
    use ApiResponse;

    function __construct() {
    }

    // public function getProductList(){
    //     $data = DB::table('PRD_VARIANT_SETUP as v')
    //                 ->select('m.COMPOSITE_CODE as sku_id','m.MKT_CODE as mkt_id','m.DEFAULT_NAME as product_name','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','m.PRIMARY_IMG_RELATIVE_PATH as primary_image','m.PK_NO as available_qty', DB::raw('(select RELATIVE_PATH from PRD_IMG_LIBRARY where PRD_IMG_LIBRARY.F_PRD_VARIANT_NO = v.PK_NO and PRD_IMG_LIBRARY.SERIAL_NO=0) as variant_primary_image'))
    //                 ->rightJoin('PRD_MASTER_SETUP as m', 'm.PK_NO', 'v.F_PRD_MASTER_SETUP_NO')
    //                 ->get();
    //     // $data = ProductVariant::rightJoin('PRD_MASTER_SETUP as m', 'm.PK_NO', 'PRD_VARIANT_SETUP.F_PRD_MASTER_SETUP_NO')
    //     //                         ->select('m.COMPOSITE_CODE as sku_id','m.MKT_CODE as mkt_id','m.DEFAULT_NAME as product_name','PRD_VARIANT_SETUP.VARIANT_NAME as product_variant_name','PRD_VARIANT_SETUP.SIZE_NAME as size','PRD_VARIANT_SETUP.COLOR as color','PRD_VARIANT_SETUP.REGULAR_PRICE as price','m.PRIMARY_IMG_RELATIVE_PATH as primary_image','m.PK_NO as available_qty', DB::raw('(select RELATIVE_PATH from PRD_IMG_LIBRARY where PRD_IMG_LIBRARY.F_PRD_VARIANT_NO = PRD_VARIANT_SETUP.PK_NO and PRD_IMG_LIBRARY.SERIAL_NO=0) as variant_primary_image'))
    //     //                         ->get();
    //     if (!empty($data)) {
    //         return $this->successResponse(200, 'Product list is available !', $data, 1);
    //     }
    //     return $this->successResponse(200, 'Data Not Found !', null, 0);
    // DB::raw('(SELECT IFNULL(COUNT(PK_NO),0) from INV_STOCK where F_BOX_NO='.$box_no->PK_NO.' and (F_BOX_NO IS NULL OR F_BOX_NO = 0))  as available_qty ')
    // }

    public function getProductList(){
        $data = Product::select('PK_NO as mp_id','DEFAULT_NAME as mp_name','PRIMARY_IMG_RELATIVE_PATH as mp_image','MODEL_NAME as mp_model', 'BRAND_NAME as mp_brand')->get();
        if (!empty($data)) {
            return $this->successResponse(200, 'Product list is available !', $data, 1);
        }
        return $this->successResponse(200, 'Data Not Found !', null, 0);
    }

    public function getVariantList($id){

        $data = DB::table('PRD_VARIANT_SETUP as v')
                    ->select('v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','m.DEFAULT_NAME as product_name','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.SEA_FREIGHT_CHARGE as sea_price', 'v.AIR_FREIGHT_CHARGE as air_price', 'v.PREFERRED_SHIPPING_METHOD as preferred_shipping_method', 'v.VAT_AMOUNT_PERCENT as vat', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image','m.PRIMARY_IMG_RELATIVE_PATH as primary_image')
                    ->leftJoin('PRD_MASTER_SETUP as m', 'm.PK_NO', 'v.F_PRD_MASTER_SETUP_NO')
                    ->where('v.F_PRD_MASTER_SETUP_NO',$id)
                    ->get();

        if (!empty($data)) {
            return $this->successResponse(200, 'Product variant data is available !', $data, 1);
        }
        return $this->successResponse(200, 'Data Not Found !', null, 0);
    }

    public function getAllVariantList($request){

        if (!empty($request->barcode) && $request->barcode != '') {
            $data = DB::table('PRD_VARIANT_SETUP as v')
                        ->select('v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','m.DEFAULT_NAME as product_name','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.SEA_FREIGHT_CHARGE as sea_price', 'v.AIR_FREIGHT_CHARGE as air_price', 'v.PREFERRED_SHIPPING_METHOD as preferred_shipping_method', 'v.VAT_AMOUNT_PERCENT as vat', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image','m.PRIMARY_IMG_RELATIVE_PATH as primary_image')
                        ->leftJoin('PRD_MASTER_SETUP as m', 'm.PK_NO', 'v.F_PRD_MASTER_SETUP_NO')
                        ->where('v.BARCODE', $request->barcode)
                        ->get();
                    if (!$data->isEmpty()) {
                        return $this->successResponse(200, 'Variant is available !', $data, 1);
                    }
                    return $this->successResponse(200, 'Data Not Found !', null, 0);
        }else{
            $data = DB::table('PRD_VARIANT_SETUP as v')
                        ->select('v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','m.DEFAULT_NAME as product_name','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.SEA_FREIGHT_CHARGE as sea_price', 'v.AIR_FREIGHT_CHARGE as air_price', 'v.PREFERRED_SHIPPING_METHOD as preferred_shipping_method', 'v.VAT_AMOUNT_PERCENT as vat', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image','m.PRIMARY_IMG_RELATIVE_PATH as primary_image')
                        ->leftJoin('PRD_MASTER_SETUP as m', 'm.PK_NO', 'v.F_PRD_MASTER_SETUP_NO')
                        ->Where('v.VARIANT_NAME', 'like', '%' . $request->product_name . '%')
                        ->where('v.COMPOSITE_CODE', 'like', '%' . $request->sku_id . '%')
                        ->Where('v.MRK_ID_COMPOSITE_CODE', 'like', '%' . $request->mkt_id . '%')
                        ->get();
            if ($data->isEmpty()) {
                return $this->successResponse(200, 'Data Not Found !', null, 0);
            }
            return $this->successResponse(200, 'Variant is available !', $data, 1);
        }
    }

    public function getVariantImg($id){
        $data = ProdImgLib::select('RELATIVE_PATH as mp_image')->where('F_PRD_VARIANT_NO', $id)->get();
        if ($data->isEmpty()) {
            $data = ProductVariant::select('PRIMARY_IMG_RELATIVE_PATH as mp_image')->where('PK_NO', $id)->get();
        }
        if (!empty($data)) {
            return $this->successResponse(200, 'Variant Image is available !', $data, 1);
        }
        return $this->successResponse(200, 'Data Not Found !', null, 0);
    }

    public function getStockSearchList($request){
        if (!empty($request->barcode) && $request->barcode != '') {
            $data = DB::table('INV_STOCK as s')
                    ->select('s.INV_WAREHOUSE_NAME','v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.PK_NO as available_qty_uk','v.PK_NO as available_qty_my','v.PK_NO as available_qty_tr_sea','v.PK_NO as available_qty_tr_air','v.PK_NO as already_booked_uk','v.PK_NO as already_booked_my','v.PK_NO as already_booked_sea','v.PK_NO as already_booked_air', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('count(s.PK_NO) as available_qty'))
                    ->join('PRD_VARIANT_SETUP as v', 'v.MRK_ID_COMPOSITE_CODE', 's.IG_CODE')
                    ->where('s.BARCODE', $request->barcode)
                    ->where('s.F_INV_WAREHOUSE_NO', 1)
                    ->whereRaw('( s.PRODUCT_STATUS IS NULL OR s.PRODUCT_STATUS = 0 OR s.PRODUCT_STATUS = 90 ) ')
                    ->groupBy('s.IG_CODE')->get();

            // $data = DB::table('PRD_VARIANT_SETUP as v')
            //         ->select('v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.PK_NO as available_qty','v.PK_NO as available_qty_uk','v.PK_NO as available_qty_my','v.PK_NO as available_qty_tr_sea','v.PK_NO as available_qty_tr_air','v.PK_NO as already_booked_uk','v.PK_NO as already_booked_my','v.PK_NO as already_booked_sea','v.PK_NO as already_booked_air', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('(SELECT IFNULL(COUNT(INV_STOCK.PK_NO),0) from INV_STOCK where INV_STOCK.PRODUCT_STATUS IS NULL OR INV_STOCK.PRODUCT_STATUS = 0 OR INV_STOCK.PRODUCT_STATUS = 90)  as total '))
            //         ->join('INV_STOCK as s', 's.IG_CODE', 'v.MRK_ID_COMPOSITE_CODE')
            //         ->where('v.BARCODE', 'like', '%' . $request->barcode . '%')
            //         // ->whereRaw('( s.PRODUCT_STATUS IS NULL OR s.PRODUCT_STATUS = 0 OR s.PRODUCT_STATUS = 90 ) ')
            //         ->groupBy('s.IG_CODE')
            //         ->get();

                    if (!$data->isEmpty()) {
                        return $this->successResponse(200, 'Variant is available !', $data, 1);
                    }
                    return $this->successResponse(200, 'Data Not Found !', null, 0);
        }else{
            $data = DB::table('INV_STOCK as s')
                        ->select('s.INV_WAREHOUSE_NAME','v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.PK_NO as available_qty_uk','v.PK_NO as available_qty_my','v.PK_NO as available_qty_tr_sea','v.PK_NO as available_qty_tr_air','v.PK_NO as already_booked_uk','v.PK_NO as already_booked_my','v.PK_NO as already_booked_sea','v.PK_NO as already_booked_air', 'v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('count(s.PK_NO) as available_qty'))
                        ->join('PRD_VARIANT_SETUP as v', 'v.MRK_ID_COMPOSITE_CODE', 's.IG_CODE')
                        ->Where('v.VARIANT_NAME', 'like', '%' . $request->product_name . '%')
                        ->where('v.COMPOSITE_CODE', 'like', '%' . $request->sku_id . '%')
                        ->Where('v.MRK_ID_COMPOSITE_CODE', 'like', '%' . $request->mkt_id . '%')
                        ->where('s.F_INV_WAREHOUSE_NO', 1)
                        ->whereRaw('( s.PRODUCT_STATUS IS NULL OR s.PRODUCT_STATUS = 0 OR s.PRODUCT_STATUS = 90 ) ')
                        ->groupBy('s.IG_CODE')->get();

                        if ($data->isEmpty()) {
                            return $this->successResponse(200, 'Data Not Found !', null, 0);
                        }
                        return $this->successResponse(200, 'Variant is available !', $data, 1);
        }
    }
////////////////////////// BOXING //////////////////////////////////////
    public function getProductBox(Request $request)
    {
        $data       = $request->json()->all();
        $string     = '';
        $response_code      = 200;
        $response_msg       = 'Boxing unsuccessfull !';
        $response_data      = null;
        $response_status    = 0;
        $col_separatior     = '~' ;
        $row_separatior     = '|' ;
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $data['user_id'])->first();

        for ($loop=0; $loop < count($data['data']); $loop++) {
           $string .= $data['data'][$loop]['sku_id'].'~'.$user_map->F_INV_WAREHOUSE_NO.'~'.$data['data'][$loop]['qty'].'|';
        }

        $box_label  = $data['box_label'];
        $count      = count($data['data']);
        // $st         = $box_label.'~'.$string.'~'.$count.'~3~'.','.'~'.';'.'~'.$data['user_id'].'~'.$data['is_update'];
        $user_id    = $data['user_id'];
        $is_update  = $data['is_update'];
        $col_parameters = 3;

        DB::beginTransaction();

        try {

            DB::statement('CALL PROC_SC_BOX_INV_STOCK(:box_label, :string, :count, :col_parameters, :col_separatior, :row_separatior, :user_id, :is_update, @OUT_STATUS);',
                array(
                    $box_label
                    ,$string
                    ,$count
                    ,$col_parameters
                    ,$col_separatior
                    ,$row_separatior
                    ,$user_id
                    ,$is_update
                )
            );

            $prc = DB::select('select @OUT_STATUS as OUT_STATUS');

            // $prc = DB::select('CALL PROC_SC_BOX_INV_STOCK(?,?,?,?,?,?,?,?,?)', [ $box_label, $string, $count, 3, $column_separatior, $row_separatior, $user_id, $is_update, '@OUT_STATUS as tt']);

           DB::table('R')->insert(
               array(
                      'R'     =>   'Inserted from Abstruct'
               )
           );
           if ($prc[0]->OUT_STATUS == 'success') {

                $response_code     = 200;
                $response_msg       = 'Boxing successfull !';
               $response_data      = null;
               $response_status    = 1;

           }elseif ($prc[0]->OUT_STATUS == 'duplicate-box') {

               $response_code      = 200;
               $response_msg       = 'Duplicate Box ! Try Unbox';
               $response_data      = null;
               $response_status    = 0;

           }else{
               $response_code      = 200;
               $response_msg       = 'Boxing unsuccessfull !';
               $response_data      = null;
               $response_status    = 1;
           }

        } catch (\Throwable $e) {
           // return $this->successResponse(200, 'Boxing Failed !', null, 0);
           return $this->successResponse(200, $e->getMessage(), null, 0);
        }

        DB::commit();


        return $this->successResponse($response_code, $response_msg, $response_data, $response_status);
    }

    ////////////////////////// REBOXING //////////////////////////////////////
    public function getRebox(Request $request)
    {
        $box_no = DB::table('SC_BOX')->select('PK_NO','F_INV_WAREHOUSE_NO')->where('BOX_NO',$request->box_label)->where('BOX_STATUS','<',30)->first();
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();
        if (empty($box_no)) {
            return $this->successResponse(200, 'Box not found !', null, 0);
        }
        if ($user_map->F_INV_WAREHOUSE_NO != $box_no->F_INV_WAREHOUSE_NO) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }

        $get_ig = Stock::selectRaw('(SELECT IFNULL(COUNT(IG_CODE),0) from INV_STOCK where IG_CODE = mkt_id and F_INV_WAREHOUSE_NO = '.$box_no->F_INV_WAREHOUSE_NO.' and (F_BOX_NO IS NULL OR F_BOX_NO = 0))')->limit(1)->getQuery();

        // $avl_qty = Stock::selectRaw('(SELECT IFNULL(COUNT(IG_CODE),0) from INV_STOCK where IG_CODE = LCCSC101102 and (F_BOX_NO IS NULL OR F_BOX_NO = 0))  as available_qty')->getQuery();

        $data = DB::table('INV_STOCK as s')
                ->select('v.PK_NO','s.INV_WAREHOUSE_NAME','v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('IFNULL(count(s.PK_NO),0) as given_qty'))
                ->selectSub($get_ig, 'available_qty')
                // ->selectRaw('(' . $avl_qty->toSql() . ') AS available_qty')
                ->join('PRD_VARIANT_SETUP as v', 'v.MRK_ID_COMPOSITE_CODE', 's.IG_CODE')
                ->where('s.F_BOX_NO', $box_no->PK_NO)
                // ->selectSub($avl_qty, 'available_qty')
                ->where('s.F_INV_WAREHOUSE_NO', $box_no->F_INV_WAREHOUSE_NO)
                ->whereRaw('( s.PRODUCT_STATUS = 10) ')
                ->groupBy('s.IG_CODE')->get();

        return $this->successResponse(200, 'Product found !', $data, 1);
    }

    ////////////////////////// UNBOX LIST FOR FIRST PAGE LOAD //////////////////////////////////////
    public function getUnboxList($request)
    {
        $box_no = Box::select('PK_NO','F_INV_WAREHOUSE_NO','BOX_STATUS')->where('BOX_NO',$request->box_label)->first();
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();
        if (empty($box_no)) {
            return $this->successResponse(200, 'Box not found !', null, 0);
        }

        $shipment_no = Shipmentbox::select('F_SHIPMENT_NO')->where('F_BOX_NO', $box_no->PK_NO)->first();
        if (empty($shipment_no)) {
            return $this->successResponse(200, 'Shipment not found !', null, 0);
        }

        $shipment_status = Shipment::select('SHIPMENT_STATUS','F_TO_INV_WAREHOUSE_NO')->where('PK_NO', $shipment_no->F_SHIPMENT_NO)->first();
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();

        if ($user_map->F_INV_WAREHOUSE_NO != $shipment_status->F_TO_INV_WAREHOUSE_NO) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }else if($shipment_status->SHIPMENT_STATUS < 80){
            return $this->successResponse(200, 'Box not arrived at destination !', null, 0);
        }else if($box_no->BOX_STATUS < 50){
                return $this->successResponse(200, 'Box not ready to unbox !', null, 0);
        }
        $data = DB::table('INV_STOCK as s')
                    ->select('v.PK_NO','s.INV_WAREHOUSE_NAME','v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('IFNULL(count(s.PK_NO),0) as given_qty'))
                    ->join('PRD_VARIANT_SETUP as v', 'v.MRK_ID_COMPOSITE_CODE', 's.IG_CODE')
                    ->where('s.F_BOX_NO', $box_no->PK_NO)
                    // ->where('s.F_INV_WAREHOUSE_NO', $box_no->F_INV_WAREHOUSE_NO)
                    ->whereRaw('( s.PRODUCT_STATUS < 40) ')
                    ->groupBy('s.IG_CODE')->get();

        return $this->successResponse(200, 'Product found !', $data, 1);
    }
    ////////////////////////// UNBOXING //////////////////////////////////////
    public function getUnbox($request)
    {
        $box_no = Box::select('PK_NO','F_INV_WAREHOUSE_NO','BOX_STATUS')->where('BOX_NO',$request->box_label)->first();
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();
        if (empty($box_no)) {
            return $this->successResponse(200, 'Box not found !', null, 0);
        }

        $shipment_no = Shipmentbox::select('F_SHIPMENT_NO')->where('F_BOX_NO', $box_no->PK_NO)->first();
        if (empty($shipment_no)) {
            return $this->successResponse(200, 'Shipment not found !', null, 0);
        }

        $shipment_status = Shipment::select('PK_NO','SHIPMENT_STATUS','F_TO_INV_WAREHOUSE_NO')->where('PK_NO', $shipment_no->F_SHIPMENT_NO)->first();
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();

        if ($user_map->F_INV_WAREHOUSE_NO != $shipment_status->F_TO_INV_WAREHOUSE_NO) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }else if($shipment_status->SHIPMENT_STATUS < 80){
            return $this->successResponse(200, 'Box not arrived at destination warehouse !', null, 0);
        }else if($box_no->BOX_STATUS < 50){
                return $this->successResponse(200, 'Box not ready no unbox !', null, 0);
        }

        DB::beginTransaction();
        try {
            Stock::where('F_BOX_NO', $box_no->PK_NO)->where('SKUID',$request->sku_id)->orderBy('PK_NO')->where('PRODUCT_STATUS','<',60)->limit($request->qty)->update(['PRODUCT_STATUS' => 60, 'F_INV_WAREHOUSE_NO' => $shipment_status->F_TO_INV_WAREHOUSE_NO, 'INV_WAREHOUSE_NAME' => $shipment_status->to_warehouse->NAME]);
            $product_count = Stock::where('F_BOX_NO',$box_no->PK_NO)->where('SKUID',$request->sku_id)->where('PRODUCT_STATUS','<',60)->get();
            if (count($product_count) == 0) {
                Box::where('PK_NO', $box_no->PK_NO)->update(['BOX_STATUS' => 60, 'F_INV_WAREHOUSE_NO' => $shipment_status->F_TO_INV_WAREHOUSE_NO,'F_BOX_USER_NO' => $request->user_id]);
            }
        //////////////////////////// RETURNING LIST AFTER SINGLE UNBOXING //////////////////////////
            $data2 = DB::table('INV_STOCK as s')
                    ->select('v.PK_NO','s.INV_WAREHOUSE_NAME','v.PK_NO','v.COMPOSITE_CODE as sku_id','v.BARCODE as barcode','v.MRK_ID_COMPOSITE_CODE as mkt_id','v.VARIANT_NAME as product_variant_name','v.SIZE_NAME as size','v.COLOR as color','v.REGULAR_PRICE as price','v.INSTALLMENT_PRICE as ins_price','v.PRIMARY_IMG_RELATIVE_PATH as variant_primary_image', DB::raw('IFNULL(count(s.PK_NO),0) as given_qty'))
                    ->join('PRD_VARIANT_SETUP as v', 'v.MRK_ID_COMPOSITE_CODE', 's.IG_CODE')
                    ->where('s.F_BOX_NO', $box_no->PK_NO)
                    // ->where('s.F_INV_WAREHOUSE_NO', $box_no->F_INV_WAREHOUSE_NO)
                    ->whereRaw('( s.PRODUCT_STATUS < 40) ')
                    ->groupBy('s.IG_CODE')->get();

        } catch (\Exception $e) {
            DB::rollback();
            return $this->successResponse(200, $e->getMessage(), null, 0);
        }
        DB::commit();
        return $this->successResponse(200, 'Unboxing successfull !', $data2, 1);
    }
}
