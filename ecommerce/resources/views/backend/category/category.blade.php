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
                        <form action="{{ route('categoryInsert') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label for="category">category</label>
                            <input type="text" name="category" id="category" placeholder="Add Category" class="form-control mt-2">
                            
                            <select name="category_id" class="form-control my-2" id="category_id">
                                <option disabled selected> Select And Parent Category </option>
                                @foreach ( $categories as $category)
                                
                                <option value="{{ $category->id }}"> {{ $category->category }} </option>

                                @endforeach
                            </select>
                            <label>Category Icon</label>
                            <input type="file" name="icon" class="form-control">

                            @error('icon')
                                <span class="text-danger">{{$message}}</span>
                            @enderror

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
                        <form action="{{ route('categoryUpdate', $findCategory->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="category">category</label>
                            <input value="{{$findCategory->category}}" type="text" name="category" id="category" placeholder="Add Category" class="form-control mt-2">

                            <select name="category_id" class="form-control my-2" id="category_id">
                                
                                @foreach ( $categories as $category)
                                 
                                @if ($findCategory->category_id != $category->id)
                                   
                                <option {{ $findCategory->category_id == $category->id ? 'selected' : '' }} value="{{ $category->id }}"> {{ $category->category }} </option>
                                
                                @endif    
                                
                                @endforeach

                            </select>
                            <label>Category Icon</label>
                            <input type="file" name="icon" class="form-control">
                            <input type="hidden" name="old" value="{{ $category->icon }}">
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
                           <td><b>{{ ++$key; }}</b></td>
                           <td><img style="width: 70px" src="{{ asset('storage/'.$category->icon) }}" alt="{{ $category->category }}"> <b>{{ $category->category}}</b></td>
                           <td><b>{{ $category->category_slug}}</b></td>
                           <td>
                            <div class="btn-group">
                                <a href="{{ route('categoryEdit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <a href="{{ route('categoryDelete', $category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                           </td>
                       </tr>

                       @if ($category->subcategories)
                           
                         @foreach ( $category->subcategories as $subcategory )
                             
                         

                          <tr align="center">
                            <td >{{ str('🚗')->repeat($loop->depth) }}</td>
                            @if ($subcategory->icon)
                                
                            <td><img style="width: 50px" src="{{$subcategory->icon ? asset('storage/'.$subcategory->icon) : "💨❌" }}" alt="{{ $subcategory->category }}"> {{ $subcategory->category }}</td>
                            @endif
                            <td>{{ $subcategory->category_slug}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('categoryEdit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="{{ route('categoryDelete', $subcategory->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </td>
                          </tr>

                          @include('layouts.components.categoryComponent')

                         @endforeach
                       @endif

                    @empty
                        <table>
                            <tr>
                                <td>NO DATA FOUND!☹</td>
                            </tr>
                        </table>
                    @endforelse

                </table>
                
            </div>
        </div>
    </div>
@endsection
