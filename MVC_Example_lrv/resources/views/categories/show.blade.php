@extends('categories.layout')
 
@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show all Products of {{ $category->name }}</h2>
            </div>
        </div>
    </div>
   
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
        </tr>
        <?php 
            $i=1;
        ?>
        @foreach ($product as $productItem)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $productItem->id }}</td>
            <td>{{ $productItem->name }}</td>
            <td>{{ $productItem->desciption }}</td>
        </tr>
        @endforeach
    </table>
    
@endsection