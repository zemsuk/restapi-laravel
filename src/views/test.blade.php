@extends(env('ADMIN_TEMPLATE') ? env('ADMIN_TEMPLATE') : "crudapi::zems_theme")
@section('content')
<div>
    <form action="{{url('zems/reset')}}" method="post">
        @csrf
        <select name="_method" id="">
            <option>GET</option>
            <option>POST</option>
            <option>PUT</option>
            <option>DELETE</option>
        </select>
        <div>
            <button>Go</button>
        </div>
    </form>
</div>
{{ Request::method() }}
<hr>
{{var_dump($method)}}
@endsection