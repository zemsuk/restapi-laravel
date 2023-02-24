@extends(env('ADMIN_TEMPLATE') ? env('ADMIN_TEMPLATE') : "crudapi::zems_theme")
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->     
    <div class="page-header all-7"> 
        <h3 class="m-0 text-primary span-6"><b>{{ucfirst(str_replace("_", " ", Route::getCurrentRoute()->getName()))}}</b></h3> 
                
    </div>
    
    <div class="content p-1">              
        
        <ul class="route_list">
            @foreach($routes as $r)
            @if(!str_starts_with($r->uri(), '_') && str_ends_with($r->uri(), '{id?}/{ext?}'))
            <?php 
            $zurl = str_replace('/{id?}/{ext?}', '', $r->uri());
            ?>
            <li><a href="{{url('/')}}/{{$zurl}}" style="text-transform:uppercase">{{$zurl}}</a></li>
            @endif
            @endforeach
        </ul>

    </div>

</div>
<!-- /.container-fluid -->
@endsection
