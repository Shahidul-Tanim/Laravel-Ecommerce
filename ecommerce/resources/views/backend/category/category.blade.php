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
                            
                            <select name="category_id" class="form-control my-2" id="category_id">
                                <option disabled selected> Select And Parent Category </option>
                                @foreach ( $categories as $category)
                                
                                <option value="{{ $category->id }}"> {{ $category->category }} </option>

                                @endforeach
                            </select>

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

                            <select name="category_id" class="form-control my-2" id="category_id">
                                <option> Select And Parent Category </option>
                            </select>

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
                        <td>Category-slug</td>
                        <td>Action</td>
                    </tr>

                    @forelse ($parentCategories as $key => $category )

                       <tr align="center">
                           <td>{{ ++$key; }}</td>
                           <td>{{ $category->category}}</td>
                           <td>{{ $category->category_slug}}</td>
                           <td>
                            <div class="btn-group">
                                <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('categoryDelete', $category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                           </td>
                       </tr>

                       @if ($category->subcategories)
                           
                         @foreach ( $category->subcategories as $subcategory )
                             
                         

                         <tr>
                          <td>--</td>
                             <td>{{ $subcategory->category }}</td>
                             <td>{{ $subcategory->category_slug}}</td>
                             <td>
                            
                             </td>
                         </tr>
                         @endforeach
                       @endif

                    @empty
                        <table>
                            <tr>
                                <td>NO DATA FOUND!</td>
                            </tr>
                        </table>
                    @endforelse

                </table>
                
            </div>
        </div>
    </div>
@endsection
