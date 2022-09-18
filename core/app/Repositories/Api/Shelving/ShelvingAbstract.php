<?php
namespace App\Repositories\Api\Shelving;
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

class ShelvingAbstract implements ShelvingInterface
{
    use ApiResponse;

    function __construct() {
    }

    public function get_available_qty($sku_id, $qty)
    {
        $info = Stock::where('SKUID', $sku_id)->whereRaw('( PRODUCT_STATUS >= 60 ) ')->count();
        if ($info < $qty) {
            return 'exeeded';
        }else{
            return 'allow';
        }
    }

    public function postShelving($request)
    {
        $request = $request->json()->all();
        $string     = '';
        $response_code      = 200;
        $response_msg       = 'Shelving unsuccessfull !';
        $response_data      = null;
        $response_status    = 0;
        $col_separatior     = '~' ;
        $row_separatior     = '|' ;
        $shelve_label     = (int)$request['shelve_label'];

        $shelve_no = DB::table('INV_WAREHOUSE_ZONES')->where('ZONE_BARCODE', $shelve_label)->first();
        if (empty($shelve_no)) {
            return $this->successResponse(200, 'Shelve not found !', null, 0);
        }

        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request['user_id'])->first();
        if ($user_map->F_INV_WAREHOUSE_NO != $shelve_no->F_INV_WAREHOUSE_NO) {
            return $this->successResponse(200, 'Unauthorized Location!', null, 0);
        }

        for ($loop=0; $loop < count($request['data']); $loop++) {

            $status = $this->get_available_qty($request['data'][$loop]['sku_id'], $request['data'][$loop]['qty']);
            if ($status == 'allow') {
                $string .= $request['data'][$loop]['sku_id'].'~'.$user_map->F_INV_WAREHOUSE_NO.'~'.$request['data'][$loop]['qty'].'|';
            }else{
                return $this->successResponse(200, 'Quantity exeeded!', null, 0);
            }
        }

        $count      = count($request['data']);
        $user_id    = $request['user_id'];
        $is_update  = $request['is_update'];
        $col_parameters = 3;
        // $st         = $shelve_label.'@@@'.$string.'~'.$count.'~'.$col_parameters.'~'.','.'~'.';'.'~'.$request['user_id'].'~'.$request['is_update'];
        DB::beginTransaction();

        try {

            DB::statement('CALL PROC_SHELVING(:shelve_label, :string, :count, :col_parameters, :col_separatior, :row_separatior, :user_id, :is_update, @OUT_STATUS);',
                array(
                    $shelve_label
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
            if ($prc[0]->OUT_STATUS == 'success') {

               $response_code     = 200;
               $response_msg       = 'Shelving successfull !';
               $response_data      = null;
               $response_status    = 1;

            }elseif ($prc[0]->OUT_STATUS == 'duplicate-box') {

               $response_code      = 200;
               $response_msg       = 'Duplicate Item !';
               $response_data      = null;
               $response_status    = 0;

            }else{
                $response_code      = 200;
                $response_msg       = 'Shelving unsuccessfull !';
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

    public function postBoxList($request)
    {
        $user_map = DB::table('SS_INV_USER_MAP')->select('F_INV_WAREHOUSE_NO')->where('F_USER_NO', $request->user_id)->first();

        $data = DB::table('SC_BOX AS b')->select('b.CODE as box_no', 'b.BOX_NO as box_label','b.ITEM_COUNT as product_count','b.USER_NAME as user_name',DB::raw('(select NAME from INV_WAREHOUSE where INV_WAREHOUSE.PK_NO = b.F_INV_WAREHOUSE_NO) as warehouse'))->where('b.F_BOX_USER_NO', $request->user_id)->where('b.F_INV_WAREHOUSE_NO',$user_map->F_INV_WAREHOUSE_NO)->get();
        if (!$data->isEmpty()) {
            return $this->successResponse(200, 'Box is available !', $data, 1);
        }
        return $this->successResponse(200, 'Box Not Found !', null, 0);
    }
}
