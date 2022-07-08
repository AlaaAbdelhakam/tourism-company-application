<!DOCTYPE html>
<html>
<head>
<meta name="_token" content="{{ csrf_token() }}">
{{-- <title>Live Search</title> --}}
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Tasks search </h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <input type="text" class="form-control form-control-dark" id="search" name="search" placeholder="Search..." aria-label="Search">
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                        <th >ID</th>
                        <th >Task title</th>
                        <th >Description</th>
                        <th >body</th>
                        <th >is_done</th>
                        <th >show</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                        <tr>
                        {{-- <th scope="row">{{ $post->id }}</th> --}}
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->body }}</td>
                        @if ($post->is_done==1)

                            <td>Done</td>
                        @else
                        <td>Not yet</td> 
                        @endif
                        <td><a class="btn btn-primary" href="{{route('posts.show',['post' => $post->id])}}">Show</a></td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '{{URL::to('search')}}',
data:{'search':$value},
success:function(data){
$('tbody').html(data);
}

});
})
</script>
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
</body>
</html>