<?php
namespace Zems\Crudapi;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Zems\Crudapi\ZemsValidation;
use DB;

class ZemsGet extends Controller
{
    public $check;
    function __construct()
    {
        $this->check = new ZemsValidation;        
    }
    
    public function index($data = false)
    {
        $zems =$data->get();
        if(Route::current()->getPrefix() == 'api'){
            return $zems;
        }
        // echo "This is index";
        // echo "<a href='./test/create'> + Create</a><hr>"; 
        // echo json_encode($query);
        if(!isset($data)){
            return view($data['view']."_".$vew, compact('zems'));
        } else {
            return view('crudapi::index', compact('zems'));
        }
    }
    public function show($data = false)
    {
        $zems = $data->find(request()->id);
        // return $zems;
        if(Route::current()->getPrefix() == 'api'){
            // echo "Yes\n";
            return $zems;
        }
        if(!isset($data)){
            return view($data['view']."_".$vew, compact('zems'));
        } else {
            return view('crudapi::details', compact('zems'));
        }
        
    }
    public function details($data = false)
    {
        $ext = Route::current()->parameters;
        $url_name = Route::current()->getName();
        if(isset($ext['id'])){
            $id = $ext['id'];
            $fields = $this->check->fields($data);
            $models = $this->check->model($data);
            $models = $models::select($fields);
            $models = $this->check->join($data, $models);
            $models = $this->check->where($data, $models);
            $models = $this->check->where_api($data, $models);
            $models = $this->check->with($data, $models); 
            $query  = $models->find($id);
            if(!$query){
                return redirect('./zems/'.$url_name);
            }
            $zems = [];
            $zems['content'] = $query; 
            $zems = $this->check->other($data, $zems);
            return $this->check->result($data, $zems, 'details');
        } else {
            return redirect('./zems/'.$url_name);
        }
    }

    public function create($data = false)
    { 
        $zems = $data;
        
        if(!isset($data)){
            return view($data['view']."_".$vew, compact('zems'));
        } else {
            return view('crudapi::create', compact('zems'));
        }
        // $models = $this->check->model($data);
        // $model_name = new $models;
        // $tableName = $model_name->getTable();
        // // $column = Schema::getColumnListing($tableName);
        
        // $column = $this->check->colum($data, $tableName);
            
        // $join = [];
        // $zems = [];
        // $zems['content'] = $column;
        // $join = $this->check->join_query($data, $join);
        // $zems = $this->check->other($data, $zems);
        // return $this->check->result_join($data, $zems, 'create', $join);
    }
    public function edit($data = false)
    {
        $zems = $data;
        
        if(!isset($data)){
            return view($data['view']."_".$vew, compact('zems'));
        } else {
            return view('crudapi::edit', compact('zems'));
        }
        $ext = Route::current()->parameters;
        $url_name = Route::current()->getName();
        $fields = $this->check->zems_fields($data);        
        if(isset($ext['id'])){
            $id = $ext['id'];
            $fields = $this->check->fields($data);
            $models = $this->check->model($data);
            $models = $models::select($fields);
            $models = $this->check->join($data, $models);
            $models = $this->check->where($data, $models);
            $models = $this->check->where_api($data, $models);
            $query  = $models->find($id);
            
            $join = [];
            $zems = [];
            if(!$query){
                return redirect('./zems/'.$url_name);
            }
            $zems['content'] = $query;
            $join = $this->check->join_query($data, $join);
            $zems = $this->check->other($data, $zems);
            return $this->check->result_join($data, $zems, 'edit', $join);
        } else {
            return redirect('./zems/'.$url_name);
        }
    }
    
}