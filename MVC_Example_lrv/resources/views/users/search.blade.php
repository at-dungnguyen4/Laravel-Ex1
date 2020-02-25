@extends('users.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Search</h2>
            </div>
            <!-- <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }}"> Create new users</a>
            </div> -->
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
            <th>Full_name</th>
            <th width="250px">Action</th>
        </tr>
        <?php 
            $i=1;
        ?>
        @foreach ($user as $user1)
        <tr>
            <td>{{ $i++ }}</td>
            <td><a href="{{ route('users.show',$user1->id) }}">{{$user1->id}}</a></td>
            <td>{{ $user1->full_name }}</td>
            <td>
                <form action="{{ route('users.destroy',$user1->id) }}" method="POST">

                    <a class="btn btn-primary" href="{{ route('users.edit',$user1->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Do you want to delete?');">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    
    {{ $user->appends(Request::all())->links() }}
@endsection