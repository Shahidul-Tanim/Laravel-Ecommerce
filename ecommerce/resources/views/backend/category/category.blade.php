@extends('backend.dashboard')
@section('main')
    <div class="container">
        <div class="row">
            <!-- FORM -->
          
            @if (Route::is('category'))
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-info">Add Category</div>
                    <div class="card-body">
                        <form action="{{ route('categoryInsert') }}" method="POST">
                            @csrf
                            <label for="category">category</label>
                            <input type="text" name="category" id="category" placeholder="Add Category" class="form-control mt-2">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-info">Edit Category</div>
                    <div class="card-body">
                        <form action="{{ route('categoryUpdate', $findCategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <label for="category">category</label>
                            <input value="{{$findCategory->category}}" type="text" name="category" id="category" placeholder="Add Category" class="form-control mt-2">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            @endif

            <!-- TABLE -->

            <div class="col-lg-8">
                <table class="table table-striped shadow">
                    <tr align="center">
                        <td>#</td>
                        <td>Category</td>
                        <td>Action</td>
                    </tr>

                    @forelse ($categories as $key => $category )

                       <tr align="center">
                           <td>{{ $categories->firstItem( ) + $key }}</td>
                           <td>{{ $category->category}}</td>
                           <td>
                            <div class="btn-group">
                                <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('categoryDelete', $category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                           </td>
                       </tr>
                        
                    @empty
                        <table>
                            <tr>
                                <td>NO DATA FOUND!</td>
                            </tr>
                        </table>
                    @endforelse

                </table>
                {{$categories->links()}}
            </div>
        </div>
    </div>
@endsection
