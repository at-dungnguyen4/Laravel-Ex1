@extends('categories.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show all Categories</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create new category</a>
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
            <th>Name</th>
            <th width="250px">Action</th>
        </tr>
        <?php 
            $i=1;
        ?>
        @foreach ($category as $item)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <form action="{{ route('categories.destroy',$item->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('categories.show',$item->id) }}">Show</a>
                    <a class="btn btn-primary" href="{{ route('categories.edit',$item->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    {{$category->links()}}
      
@endsection