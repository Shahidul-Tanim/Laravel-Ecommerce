@if ($subcategory->subcategories)
                           
@foreach ( $subcategory->subcategories as $subcategory )
    


<tr align="center">
   <td>{{ str('🚗')->repeat($loop->depth) }}</td>
   @if ($subcategory->icon)
      
   <td><img style="width: 50px" src="{{$subcategory->icon ? asset('storage/'.$subcategory->icon) :"" }}" alt="{{ $subcategory->category }}"> {{ $subcategory->category }}</td>
   @endif
   <td>{{ $subcategory->category_slug}}</td>
   <td>
      <div class="btn-group">
         <a href="{{ route('category.edit', $subcategory->id) }}" class="btn btn-warning btn-sm">Edit</a>
         <a href="{{ route('category.delete', $subcategory->id) }}" class="btn btn-danger btn-sm">Delete</a>
     </div>
   </td>
</tr>
@include('layouts.components.categoryComponent')
@endforeach
@endif