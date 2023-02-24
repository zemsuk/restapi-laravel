@extends(env('ADMIN_TEMPLATE') ? env('ADMIN_TEMPLATE') : "crudapi::zems_theme")
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->     
    <div class="page-header all-7"> 
        <h3 class="m-0 text-primary span-6">All <b>{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</b></h3> 
        <div class="text-right">
            <a href="{{url('/')}}/{{Route::getCurrentRoute()->getName()}}" class="button btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fa-solid fa-reply-all"></i>
                </span>
                <span class="text">{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</span>
            </a>
        </div>        
    </div>
    <?php
    $items = json_decode($zems);
    ?>
    <div class="content p-1">              
        @foreach($items as $key=>$item)
        <?php
        $tt = explode("_", $key);
        $tl = "";
        foreach($tt as $t){
            if($t != 'id'){
                $tl .= " ".ucfirst($t);
            }
        }
        ?>
        @if($key != 'id' && $key != 'media' && $key != 'source' && $key != 'status')
        <div class="mt-2"><b>{{$tl}}</b></div>
        <div>{!! $items->$key !!}</div>
        @endif
        @if($key == 'status')
        <div class="mt-2"><b>{{$tl}}</b></div>
        <div>
            <?php 
                $st = [1=>'Active', 0=>'Inactive'];
                echo $st[$items->$key];
            ?>                
        </div>
        @endif
        <hr>
        @endforeach
        

        <h5 class="mt-4">Action</h5>
        <div class="mb-1">
            <a href="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$items->id}}/edit" class="button btn-icon-split justify-content-left">
                <span class="icon text-white-50">
                    <i class="fas fa-edit"></i>
                </span>
                <span class="text">Edit {{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</span>
            </a>
        </div>
        
        <form action="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$items->id}}" method="post">
            @csrf
            @method('DELETE')            
            <button class="button btn-icon-split bg-error">
                <span class="icon">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete {{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</span>
            </button>
        </form>
    </div>

</div>
<!-- /.container-fluid -->
@endsection
