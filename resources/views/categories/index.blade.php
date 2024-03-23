@extends('Categories.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
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
            <th>name</th>
            <th>short_description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($Categories as $Category)
        <tr>
            <td>{{ $Category->name }}</td>
            <td>{{ $Category->short_description }}</td>
            <td>
                <form action="{{ route('categories.destroy',$Category->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('categories.show',$Category->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('categories.edit',$Category->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
      
@endsection