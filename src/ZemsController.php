<?php
namespace Zems\Crudapi;

use App\Http\Controllers\Controller;
use Zems\Crudapi\ZemsGet;
use Zems\Crudapi\ZemsPost;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use DB;

class ZemsController extends Controller
{
    public $method;
    public $request;
    public static $query;
    public static $qselect;
    public static $base_model;
    public static $joinTable;
    // function __construct(Request $request)
    // {
    //     // $this->method = $method;
    //     $this->method = $request->method();
    //     $this->request = $request;
        
    // }  
    public static function model($val){
        $model= "\App\\Models\\".$val;
        static::$query= new $model;
        static::$base_model = $val;
        // static::$query= \App\Models\Setting::get();
        return new static;      
    }
    public static function select(...$val){
        static::$qselect = array(...$val);
        static::$query = static::$query->select($val); 
        return new static;      
    }
    public static function join(...$val){
        // if(static::$joinTable == null){
        //     static::$joinTable = array(...$val);
        // } else {
        // }
        static::$joinTable = array(static::$joinTable, array(...$val));
        // print_r(static::$joinTable);
        static::$query = static::$query->join(...$val); 
        return new static;      
    }
    public static function where(...$val){
        static::$query = static::$query->where(...$val); 
        return new static;      
    }
    public static function whereBetween($col, $val){
        if(request()->id == null){
            static::$query = static::$query->whereBetween($col, $val); 
        }
        return new static;      
    }
    public static function offset($val){
        if(request()->id == null){
            static::$query = static::$query->offset($val); 
        }
        return new static;      
    }
    public static function limit($val){
        static::$query = static::$query->limit($val); 
        return new static;      
    }    
    public static function orderBy(...$val){
        static::$query = static::$query->orderBy(...$val); 
        return new static;      
    }
    public static function paginate($val){
        return static::$query->paginate($val);
    }
    public static function get(){
        return static::zems();
        // return view('test');

        // return static::$query->get();
    }

    public static function zems()
    {
        $method = request()->method();        
        $action = ['POST', 'PUT', 'DELETE'];
        if(in_array($method, $action)){
            $zemsPost = new ZemsPost();
            $go = "zems_".strtolower($method);            
            return $zemsPost->$go(static::$base_model);
        } else {
            $zems_get = new ZemsGet();
            if(request()->id == 'create'){
                $jtbl = static::$joinTable;
                $tbl = [];
                if($jtbl != null){
                    foreach($jtbl as $join){
                        if(!is_null($join)){
                            $dep = DB::table($join[0])->get();
                            $tbl[$join[0]] = $dep;                           
                        }
                    }
                }
                // echo json_encode($tbl); 
                $tableName = Str::plural(static::$base_model);
                $fields = Schema::getColumnListing($tableName);
                $data = ["fields"=>$fields, "tbl"=>$tbl];
                return $zems_get->create($data);
            } elseif(request()->id != null && is_numeric(request()->id)) {
                if(request()->ext == 'edit'){
                    $jtbl = static::$joinTable;
                    $tbl = [];
                    if($jtbl != null){
                        foreach($jtbl as $join){
                            if(!is_null($join)){
                                $dep = DB::table($join[0])->get();
                                $tbl[$join[0]] = $dep;                           
                            }
                        }
                    }
                    // echo json_encode($tbl); 
                    $tableName = Str::plural(static::$base_model);
                    $editDataModel = static::$base_model; 
                    $editDataModel = "\App\\Models\\".$editDataModel; 
                    $editDataModel = new $editDataModel; 
                    $result = $editDataModel->find(request()->id);
                    $data = ["result"=>$result, "tbl"=>$tbl];                    
                    return $zems_get->edit($data);
                } elseif(request()->id != null && is_numeric(request()->id)){
                    // echo " Ids ".request()->id; //3 show
                    // return static::$query->find(1);
                    return $zems_get->show(static::$query);
                }
            } 
            // else {
            //     return $zems_get->index();
            // }
        }        
        return $zems_get->index(static::$query);
    }
    
}
