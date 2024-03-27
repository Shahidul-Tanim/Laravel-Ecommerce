@extends('layouts.backendLayouts')
@section('main')

<div class="container-fluid">

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mt-5">
            {{-- button --}}
            <div class="col-12 text-end mb-4">
                <button type="submit" class="main-btn dark-btn-outline square-btn btn-hover">Store Product</button>
            </div>
            {{-- button ends --}}
            {{-- Display --}}
            <div class="col-lg-8">
                {{-- carrd --}}
                <div class="card-style">
                    <h5 class="mb-25">Add Title</h5>
                    <div class="input-style-2">
                        <input name="title" type="text" placeholder="Product Title">
                        <span class="icon"> <i class="lni lni-producthunt"></i> </span>
                        @error('title')
                            <sapn class="text-danger">{{ $message }}</sapn>
                        @enderror
                    </div>
        
                    {{-- 2 --}}
                    <div class="row">
                        <div class="col-lg-6">
        
                            {{--  --}}
                            <div class="input-style-2">
                                <input name="price" type="text" placeholder="Product Price">
                                <span class="icon"> <i class="lni lni-pound"></i> </span>
                                @error('price')
                                <sapn class="text-danger">{{ $message }}</sapn>
                                @enderror
                            </div>
                            {{--  --}}
        
                        </div>
                        <div class="col-lg-6">
                            {{--  --}}
                            <div class="input-style-2">
                                <input name="sell_price" type="text" placeholder="Product Discount Price">
                                <span class="icon"> <i class="lni lni-cut"></i> </span>
                                @error('sell_price')
                                <sapn class="text-danger">{{ $message }}</sapn>
                                @enderror
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                    {{-- 2 --}}
                    {{-- 3 --}}
                    <div class="row">
                        <div class="col-lg-4">
        
                            {{--  --}}
                            <div class="input-style-2">
                                <input name="sku" type="text" placeholder="Sku">
                                <span class="icon"> <i class="lni lni-atlassian"></i> </span>
                                @error('sku')
                                <sapn class="text-danger">{{ $message }}</sapn>
                                @enderror
                            </div>
                            {{--  --}}
                        </div>
                        <div class="col-lg-4">
                            {{--  --}}
                            <div class="select-style-1">
                               <div class="select-position">
                                   <select name="stock">
                                    <option selected value="{{ 1 }}">In Stock</option>
                                    <option value="{{ 0 }}">Out Of Stock</option>
                                   </select>
                               </div>
                                @error('storck')
                                <sapn class="text-danger">{{ $message }}</sapn>
                                @enderror
                            </div>
                            {{--  --}}
                        </div>
                        <div class="col-lg-4">
                            {{--  --}}
                            <div class="input-style-2">
                                <input name="brand" type="text" placeholder="Brand Name">
                                <span class="icon"> <i class="lni lni-java"></i> </span>
                                @error('brand')
                                <sapn class="text-danger">{{ $message }}</sapn>
                                @enderror
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                    {{-- 3 --}}
                    {{-- detail --}}
                    <div class="clo-lg-12">
                        <div class="input-style-2">
                            <textarea name="short_detail" placeholder="Short Detail"></textarea>
                            @error('short_detail')
                            <sapn class="text-danger">{{ $message }}</sapn>
                            @enderror
                        </div>
                    </div>

                    <div class="clo-lg-12">
                        <div class="input-style-2">
                            <textarea name="long_detail" placeholder="Long Detail"></textarea>
                            @error('long_detail')
                            <sapn class="text-danger">{{ $message }}</sapn>
                            @enderror
                        </div>
                    </div>
                    {{-- detail --}}
                    {{-- btn --}}
                    <div class="d-lg-flex">
                        <div class="form-check form-switch toggle-switch me-5">
                            <input class="form-check-input" name="status" type="checkbox" id="status" checked value="{{ 1 }}">
                            <label class="form-check-label" for="status">Status</label>
                        </div>
                        <div class="form-check form-switch toggle-switch">
                            <input class="form-check-input" name="featured" type="checkbox" id="featured" value="{{ 1 }}">
                            <label class="form-check-label" for="featured">Featured Product</label>
                        </div>
                    </div>
                    {{-- btn --}}
                </div>
                {{-- card --}}
            </div>
            {{-- lg8 end --}}
            <div class="col-lg-4">
               {{-- CARD --}}
                <div class="card-style">
                    {{-- image --}}
                    <div class="input-style-1">
                        <label>Featured Image</label>
                        <input name="featured_img" type="file">
                        @error('featured_img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-style-1">
                        <label>Gallery Images</label>
                        <input name="galleries[]" type="file" multiple>
                        @error('galleries.*')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-style-1">
                        <label>Category</label>
                        <select style="width: 100%" multiple name="categories[]" class="categoryItems">
                           
                            @foreach ($categories as $category )
                                <option value="{{ $category->id }}">{{ str($category->category )->headline()}}</option>
                            @endforeach

                        </select>
                    </div>
        
                    {{-- image --}}
                </div>
               {{-- CARD --}}
            </div>
            {{-- lg4 end--}}
            {{-- Display --}}
        </div>
    </form>

</div>

@push('customCss')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2 span{
        display: block !important;
    }
</style>

@endpush
@push('customJs')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.categoryItems').select2();
});
</script>
@endpush

@endsection