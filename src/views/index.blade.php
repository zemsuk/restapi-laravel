@extends(env('ADMIN_TEMPLATE') ? env('ADMIN_TEMPLATE') : "crudapi::zems_theme")
 
@section('content')
<div class="container-fluid">
    <div class="page-header all-7"> 
        <h3 class="m-0 text-primary span-6">All <b>{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</b></h3> 
        <div class="text-right">
            <a href="{{url('/')}}/{{Route::getCurrentRoute()->getName()}}/create" class="button btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Create New</span>
            </a>
        </div>        
    </div>
    <!-- DataTales Example -->
    @if (\Session::has('msg'))
    <div class="alert alert-success fade show" role="alert">
        {!! \Session::get('msg') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="table">
        <?php 
            $i = 0; 
            $column = [];
            $fst = "title";
            $scnd = "details";
            $hd = json_decode($zems);
            if($hd != null){
            foreach($hd[0] as $k=>$it){
                if($k != 'id'){ 
                    $column[] = $k; 
                    if(0 < $i++){ break; } 
                }           
            }
            $fst = ($column[0]);
            $scnd = ($column[1]);
            }            
        ?>
        <div class="small-4 head">
            <div class="item">{{$fst}}</div>
            <div class="item span-2">{{$scnd}}</div>
            <div class="item text-center">Action</div>
        </div>
        @if(count($zems) != 0)
        @foreach($zems as $item)
        <div class="small-4 row">
            <div class="item">{{$item->$fst}}</div>
            <div class="item span-2">{!! $item->$scnd !!}</div>
            <div class="item_action all-3">
                <a class="button" href="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$item->id}}" title="View"><i class="fas fa-eye"></i></a>
                
                <a class="button" href="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$item->id}}/edit" title="Edit"><i class="fas fa-edit"></i></a>
                
                <form class="inline_form" action="{{ url('/') }}/{{Route::getCurrentRoute()->getName()}}/{{$item->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="button" title="Delete"><i class="fas fa-trash"></i></button>
                </form>
                
            </div>
        </div>
        @endforeach
        @else 
        <div class="span-3 border text-center p-1">No Data Found</div>
        @endif
    </div>

</div>
@endsection