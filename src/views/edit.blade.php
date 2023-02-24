@extends(env('ADMIN_TEMPLATE') ? env('ADMIN_TEMPLATE') : "crudapi::zems_theme")
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->  
    <div class="page-header all-7"> 
        <h3 class="m-0 text-primary span-6">Edit <b>{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</b></h3> 
        <div class="text-right">
            <a href="{{url('/')}}/{{Route::getCurrentRoute()->getName()}}" class="button btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-reply-all"></i>
                </span>
                <span class="text">{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</span>
            </a>
        </div>         
    </div>   
    <div class="content p-1">
        <?php $data = json_decode($zems['result']); ?> 
        <form action="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$data->id}}" method="post">
            @csrf
            @method('put')
        <div class="small-5 table">     
            @foreach($data as $fl => $val)
            <div class="item">
                <?php 
                $exp = explode(".", $fl);
                if(isset($exp[1])){
                    $field_name = $exp[1];
                } else {
                    $field_name = $fl;
                }
                $flexp = explode('_', $field_name);
                if(isset($flexp[1])){
                    $name = $flexp[0];
                } else {
                    $name = $fl;
                }
                echo $name;
                ?>
            </div>
            <div class="span-4 item">
                <?php //echo json_encode($zems['tbl']); ?>
                @if(array_key_exists(\Str::plural($name), $zems['tbl']))
                    
                    <select name="{{$field_name}}" id="">
                        @foreach($zems['tbl']['pages'] as $item)
                        <?php
                            if($item->id == $val){
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                        ?>
                        <option value="{{$item->id}}" {{$selected}}>{{$item->name}}</option>
                        @endforeach
                    </select>
                @else 
                <input type="text" name="{{$field_name}}" value="{{$val}}">
                @endif
            </div>
            @endforeach
        </div>
        <div>
            <button class="button btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-floppy-disk"></i>
                </span>
                <span class="text">Update</span>
            </button>
        </div>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
@endsection

@section('script')
<script src="{{asset('js/zems_uploader.js')}}"></script>
@endsection