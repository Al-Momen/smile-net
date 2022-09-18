<?php
namespace App\Repositories\Api\Shipment;
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

class ShipmentAbstract implements ShipmentInterface
{
    use ApiResponse;

    function __construct() {
    }

    public function ShipmentPost($request)
    {
        $shipment_label = (int)$request->shipment_label/1000;
        $shipment_label = floor($shipment_label);
        $box_serial     = (int)$request->shipment_label%1000;
        $box_label      = (int)$request->box_label;

        $shipment_master = Shipment::where('CODE', $shipment_label)->whereRaw('( SHIPMENT_STATUS IS NULL OR SHIPMENT_STATUS = 10 )')->first();
        if (empty($shipment_master)) {
            return $this->successResponse(200, 'Shipment not found!', null, 0);
        }

        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();
        $box_master = Box::where('BOX_NO', $box_label)->where('BOX_STATUS', 10)->orWhere('BOX_STATUS', 20)->first();

        if (empty($box_master)) {
            return $this->successResponse(200, 'Box not found !', null, 0);
        }else if (($user_map->F_INV_WAREHOUSE_NO != $box_master->F_INV_WAREHOUSE_NO) || ($box_master->F_INV_WAREHOUSE_NO != $shipment_master->F_FROM_INV_WAREHOUSE_NO)) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }

        $box_master['serial'] = $box_serial;

        $inv_stock = Stock::select('F_SHIPPMENT_NO','SHIPMENT_NAME','F_BOX_NO')->where('F_BOX_NO', $box_master->PK_NO)->get();
        if (empty($inv_stock)) {
            return $this->successResponse(200, 'Box item not found!', null, 0);
        }
        $shipment_box = Shipmentbox::where('F_SHIPMENT_NO',$shipment_master->PK_NO)->whereRaw('BOX_SERIAL = '.$box_serial.' OR F_BOX_NO = '.$box_master->PK_NO)->first();

        if (!empty($shipment_box)) {
            return $this->successResponse(200, 'Duplicate Entry', null, 0);
        }

        $inv_stock = $inv_stock->toArray();
        DB::beginTransaction();
        try {
            // foreach ($inv_stock as $key => $value) {
                Stock::where('F_BOX_NO', $box_master->PK_NO)->update(['F_SHIPPMENT_NO' => $shipment_master->PK_NO,
                                                                    'SHIPMENT_NAME' => $shipment_master->CODE]);
            // }
            $shipment_box = new Shipmentbox();
            $shipment_box->F_SHIPMENT_NO = $shipment_master->PK_NO;
            $shipment_box->BOX_SERIAL    = $box_serial;
            $shipment_box->F_BOX_NO      = $box_master->PK_NO;
            $shipment_box->PRODUCT_COUNT = $box_master->ITEM_COUNT;
            $shipment_box->save();

        } catch (\Exception $e) {
            DB::rollback();
            return $this->successResponse(200, $e->getMessage(), null, 0);
        }
        DB::commit();

        return $this->successResponse(200, 'Box added successfully !', $box_master, 1);
    }

///////////////////////////////// SHIPMENT RECIEVED AT DESZTINATION ///////////////////////////
    public function shipmentReceived($request)
    {
        // $shipment_label = (int)$request->shipment_label/1000;
        // $shipment_label = floor($shipment_label);
        // $box_serial     = (int)$request->shipment_label%1000;
        $box_label      = (int)$request->box_label;

        $box_master = Box::where('BOX_NO', $request->box_label)->where('BOX_STATUS','<=', 40)->first();
        if (empty($box_master)) {
            return $this->successResponse(200, 'Box not ready to release !', null, 0);
        }
        $shipment_no = Shipmentbox::select('F_SHIPMENT_NO')->where('F_BOX_NO', $box_master->PK_NO)->first();
        if (empty($shipment_no)) {
            return $this->successResponse(200, 'Box not found!', null, 0);
        }
        $shipment_status = Shipment::select('SHIPMENT_STATUS','F_TO_INV_WAREHOUSE_NO')->where('PK_NO', $shipment_no->F_SHIPMENT_NO)->first();
        if (empty($shipment_status)) {
            return $this->successResponse(200, 'Shipment not found!', null, 0);
        }
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();

        if ($user_map->F_INV_WAREHOUSE_NO != $shipment_status->F_TO_INV_WAREHOUSE_NO) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }else if($shipment_status->SHIPMENT_STATUS == 70){
            $box_id = Shipmentbox::select('F_BOX_NO')->where('F_SHIPMENT_NO',$shipment_no->F_SHIPMENT_NO)->get();
            foreach ($box_id as $key => $value) {
                Box::where('PK_NO', $value->F_BOX_NO)->update(['BOX_STATUS' => 50]);
            }
                return $this->successResponse(200, 'Shipment Received successfully !', null, 1);
        }else {
            return $this->successResponse(200, 'Please try again !', null, 0);
        }
    }
}
