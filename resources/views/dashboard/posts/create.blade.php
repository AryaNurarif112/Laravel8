@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap 
align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Create New Posts</h1>
  </div>

<div class="col-lg-8">
  <form method="post" action="/dashboard/posts" class="mb-5" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" 
      id="title" name="title" required autofocus value="{{old('title')}}">
      @error('title')
      <div class="invalid-feeback">
      {{ $message }}
       </div>
      @enderror
    </div>
    <div class="mb-3">
      <label for="slug" class="form-label">Slug</label>
      <input type="text" class="form-control  @error('slug') is-invalid @enderror" 
      id="slug" name="slug" required value="{{old('slug')}}">
      @error('slug')
      <div class="invalid-feeback">
      {{ $message }}
       </div>
      @enderror
      {{-- eloquent sluggable --}}
    </div>
    <div class="mb-3">
      <label for="category" class="form-label">Category</label>
      <select class="form-select" name="category_id">
       @foreach ( $categories as $category)
       @if(old('category_id') == $category->id)
         <option value="{{$category->id}}" selected>{{$category->name}}</option>
        {{-- $categories itu berada di DashboardPostController di bagian create --}}
        @else
          <option value="{{$category->id}}">{{$category->name}}</option>
        @endif
        @endforeach
      </select>
    </div>
    <div class="mb-3">
      <label for="image" class="form-label">Post Image</label>
      <input class="form-control" type="file" id="image" name="image">
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      @error('body')
      <p class="text-danger">{{ $message }}</p>
      @enderror
      <input id="body" type="hidden" name="body" value="{{ old('body') }}">
      <trix-editor input="body"></trix-editor>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
  </form>
</div>

<script>
const title = document.querySelector('#title')
const slug = document.querySelector('#slug')

title.addEventListener('change', function(){
  fetch('/dashboard/posts/checkSlug?title=' + title.value) 
  //karena menggunakan nya get maka kirim title yang berisikan title.value. Jadi apa yang kita isikan title akan masuk ke method createSlug di 
  // olah kembali ke method ini /dashboard/posts/checkSlug?title= dan dijadikan sebagai slug.value = data.slug
  .then(response => response.json())
  .then(data => slug.value = data.slug)
})

document.addEventListener('trix-file-accept', function(e){
  e.preventDefault();
  // supaya tidak jalan tools lampirannya
})

</script>

@endsection