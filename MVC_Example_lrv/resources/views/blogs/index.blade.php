@extends('blogs.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show all Blogs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('blogs.create') }}"> Create new blogs</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Title</th>
            <th>Content</th>
            <th width="250px">Action</th>
        </tr>
        <?php 
            $i=1;
        ?>
        @foreach ($blogs as $blog)
        <tr>
            <td>{{ $i++ }}</td>
            <td> <a href="{{ route('blogs.show',$blog->id) }}">{{$blog->id}}</a></td>
            <td>{{ $blog->title }}</td>
            <td>{{ $blog->content }}</td>
            <td>
                <form action="{{ route('blogs.destroy',$blog->id) }}" method="POST">
   
                   
    
                    <a class="btn btn-primary" href="{{ route('blogs.edit',$blog->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $blogs->links() }}
      
@endsection