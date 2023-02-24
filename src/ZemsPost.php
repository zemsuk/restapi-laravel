<?php
namespace Zems\Crudapi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Zems\Crudapi\ZemsValidation;

class ZemsPost extends Controller
{
    public $check;
    function __construct()
    {
        $this->check = new ZemsValidation;        
    }
    public function index()
    {
        return "PosT";
    }
    public function zems_post($data = false)
    {
        $models = "\App\\Models\\".$data;
        $store = new $models;
        // return "Test";
        $json_data = $this->check->input_data($store);
        if($store->save()){
            // return "Saved";
            $zems['content']['id'] = $store->id;
            $zems['content'] = $json_data;
            if(isset($data['other'])){
                foreach($data['other'] as $key => $other){
                    $zems['other'][$key] = $other;
                }
            }
            if(Route::current()->getPrefix() != 'api'){   
                $current_route = Route::current()->getName(); 
                return redirect("/".$current_route)->with(['msg' => 'Data Insterted Successfully', 'zems'=>$zems]);                
            }else{
                return $zems;
            }
        } else {
            return ['error'=>'Ops!! Something went wrong!! Please Try againg'];
        }
    }
    public function zems_put($data = false)
    {
        // return "Hello put";
        $models = "\App\\Models\\".$data;
        $models = new $models;
        $id = request()->id;        
        $store = $models::find($id);       
        $json_data = $this->check->input_data($store);        
        if($store->save()){
            $zems['content'] = $json_data;
            if(isset($data['other'])){
                foreach($data['other'] as $key => $other){
                    $zems['other'][$key] = $other;
                }
            }
            if(request()->route()->getPrefix() != 'api'){   
                $current_route = request()->route()->getName();
                return redirect("/".$current_route)->with(['msg' => 'Data Updated Successfully', 'zems'=>$zems]);                
            }else{
                return $zems;
            }
        } else {
            return ['error'=>'Ops!! Something went wrong!! Please Try againg'];
        }
    }
    public function zems_delete($data = false)
    {
        $models = "\App\\Models\\".$data;
        $models = new $models;
        $id = request()->id;
        $store = $models::find($id);        
        if($store->delete()){
            $zems['content'] = ['id' => $id];
            if(isset($data['other'])){
                foreach($data['other'] as $key => $other){
                    $zems['other'][$key] = $other;
                }
            }
            if(request()->route()->getPrefix() != 'api'){   
                $current_route = request()->route()->getName(); 
                return redirect("/".$current_route)->with(['msg' => 'Data Deleted Successfully', 'zems'=>$zems]);                
            }else{
                return $zems;
            }
        } else {
            return ['error'=>'Ops!! Something went wrong!! Please Try againg'];
        }
    }
}