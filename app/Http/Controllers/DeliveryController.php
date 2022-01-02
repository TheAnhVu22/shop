<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delivery;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Exports\ExcelExports;
use App\Imports\ExcelImports;
use App\Models\CategoryProduct;
use Excel;
class DeliveryController extends Controller
{
    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship = Delivery::find($data['feeship_id']);
        // hàm rtrim() loại vỏ khoảng trắng hay 1 ký tự nào đó ở giá trị thứ 2
        $fee_value = rtrim($data['fee_value'],'.');
        $fee_ship->feeship = $fee_value;
        $fee_ship->save();
    }

    // bảng danh sách các địa chỉ đã thêm phí
    public function select_feeship(){
        $feeship = Delivery::with('city','province','wards')->orderby('id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive" id="xxx">  
            <table class="table table-bordered">
                <thread> 
                    <tr>
                        <th>Tên thành phố</th>
                        <th>Tên quận huyện</th> 
                        <th>Tên xã phường</th>
                        <th>Phí ship</th>
                    </tr>  
                </thread>
                <tbody>
                ';

                foreach($feeship as $key => $fee){

                $output.='
                    <tr>
                        <td>'.$fee->city->name_tp.'</td>
                        <td>'.$fee->province->name_qh.'</td>
                        <td>'.$fee->wards->name_xa.'</td>
                        <td contenteditable data-feeship_id="'.$fee->id.'" class="fee_feeship_edit">'.$fee->feeship.'</td>
                    </tr>
                    ';
                }

                $output.='      
                </tbody>
                </table></div>
                ';

                echo $output;

        
    }
    public function insert_delivery(Request $request){
        $data = $request->all();
        $fee_ship = new Delivery();
        $fee_ship->thanhpho_id = $data['city'];
        $fee_ship->quanhuyen_id = $data['province'];
        $fee_ship->xa_id = $data['wards'];
        $fee_ship->feeship = $data['fee_ship'];
        $fee_ship->save();
    }
 // hiển thi giao diện chọn địa chỉ
    public function delivery(Request $request){

        $city = City::orderby('matp','ASC')->get();

        return view('admincp.delivery.add_delivery',compact('city'));
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action']=="city"){
                $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                    $output.='<option>---Chọn quận huyện---</option>';
                foreach($select_province as $key => $province){
                    $output.='<option value="'.$province->maqh.'">'.$province->name_qh.'</option>';
                }

            }else{

                $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>---Chọn xã phường---</option>';
                foreach($select_wards as $key => $ward){
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_xa.'</option>';
                }
            }
            echo $output;
        }
        
    }
    public function export_category(){
        return Excel::download(new Excelexports , 'category_product.xlsx');
    }
    public function import_category(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImports, $path);
        return back();
    }
}
