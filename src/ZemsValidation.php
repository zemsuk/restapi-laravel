<?php
namespace Zems\Crudapi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use DB;

class ZemsValidation extends Controller
{
    public function index()
    {
        return "Validation";
    }
    public function fields($data = false)
    {
        if(isset($data['fields'])){
            $fields = $data['fields'];
        } else {
            $fields = "*";
        }
        return $fields;
    }
    public function zems_fields($data = false)
    {
        if(isset($data['fields'])){
            $model = $data['model'];
            $models = 'App\\Models\\'.$model;
            $tbl = new $models;
            $tableName = $tbl->getTable();
            $fields = [];
            foreach($data['fields'] as $field){
                $cln = explode(".", $field);
                if(isset($cln[1])){
                    if($cln[1] == "*" && $cln[0] == $tableName){
                        $fields = Schema::getColumnListing($tableName);
                        break;
                    } else
                    if($cln[0] == $tableName){                        
                        $fields[] = $cln[1];
                    }
                } else {
                    $fields[] = $cln[0];
                }
            }
        } else {
            $fields = "*";
        }
        return $fields;
    }

    public function zems_valid($fields)
    {
        $fRequired = [];
        foreach($fields as $fk){
            if (!array_key_exists($fk, request()->post())) { 
                if(strtolower($this->method) == 'post' && $fk == 'id'){
                    // $fRequired[] = $fk.' is Ok'; 
                } else {
                    // $fRequired[] = '<b>'.$fk.'</b> is Required';
                    $fRequired[$fk] = 'is Required';
                }
            } 
        }
        // return $fRequired;
        if($fRequired) {
            // echo "<hr>";
            // foreach($fRequired as $fr){
            //     echo "<div style='color:red'>$fr</div>";
            // }
            // echo "<hr>";
            echo json_encode($fRequired);
            exit();
        } 
    }
    public function input_data($store = false)
    {
        $req = request()->all();        
        $data = [];
        foreach($req as $k => $r){
            if($k != "_token" && $k != "_method" && $k != "_file"){                
                $store->$k = $r;
                $data[$k] = $r;
            }
        }      
        return $data;
    }
    public function model($data = false)
    {
        $model = $data['model'];
        $models = 'App\\Models\\'.$model;
        return $models;
    }
    public function join($data = false, $models)
    {
        if(isset($data['join'])){        
            foreach($data['join'] as $join_table => $field){                
                $models = $models->join($join_table, $field[0], '=', $field[1]);
            }
        } 
        return $models;
    }
    public function join_query($data = false, $join)
    {        
        if(isset($data['join'])){        
            foreach($data['join'] as $join_table => $field){
                $tbl = explode(".",$field[0]);     
                $tbl_name = $tbl[1];  
                // $this->join_field($data);
                $result = DB::table($join_table);
                if(isset($data['join_field'][$join_table])){
                    $result = $result->select($data['join_field'][$join_table]);
                }
                if(isset($data['join_where'][$join_table])){
                    $result = $result->where([['type', 'services']]);
                }
                $result = $result->get();
                $join[$tbl_name] = $result;
            }
        } 
        return $join;
    }
    public function join_field($data = false)
    {
        echo "Hi <pre>";
        print_r($data['join_field']);
        exit();
    }
    public function where($data = false, $models)
    {
        if(isset($data['where'])){
            $models = $models->where($data['where']);
        } 
        return $models;
    }
    public function where_api($data = false, $models)
    {
        if(Route::current()->getPrefix() == 'api'){         
            if(isset($data['where_api'])){
                $models = $models->where($data['where_api']);
            }
        } 
        return $models;
    }
    public function with($data = false, $models)
    {
        if(isset($data['with'])){
            $models = $models->with($data['with']);
        } 
        return $models;
    }
    public function order_by($data = false, $models)
    {
        if(isset($data['order_by'])){
            $models = $models->orderBy($data['order_by'][0], $data['order_by'][1]);           
        } 
        return $models;
    }
    public function group_by($data = false, $models)
    {
        if(isset($data['group_by'])){
            $models = $models->groupBy($data['group_by']);           
        } 
        return $models;
    }
    public function limit($data = false, $models)
    {
        if(isset($data['limit'])){
            $models = $models->limit($data['limit']);
        } 
        return $models;
    }
    public function pagination($data = false, $models)
    {
        if(isset($data['pagination'])){
            $json_data = $models->paginate($data['pagination']);            
        } else {
            $json_data = $models->get();
        } 
        return $json_data;
    }
    public function other($data = false, $zems)
    {
        if(isset($data['other'])){            
            foreach($data['other'] as $key => $other){
                $zems['other'][$key] = $other;
            }
        } 
        return $zems;
    }
    public function colum($data = false, $tableName)
    {
        if(isset($data['fields'])){   
            $column = $this->zems_fields($data);
        } else {
            $column = Schema::getColumnListing($tableName);
        }
        return $column;
    }
    public function result($data = false, $zems, $vew = false)
    {
        if(Route::current()->getPrefix() == '/zems'){
            if(isset($data['view'])){
                return view($data['view']."_".$vew, compact('zems'));
            } else {
                return view('crudapi::'.$vew, compact('zems'));
            }  
        }
        return $zems;
    }
    public function result_join($data = false, $zems, $vew = false, $join = false)
    {
        if(Route::current()->getPrefix() == '/zems'){
            if(isset($data['view'])){
                return view($data['view']."_".$vew, compact('zems', 'join'));
            } else {
                return view('crudapi::'.$vew, compact('zems', 'join'));
            }  
        }
        return $zems;
    }
}