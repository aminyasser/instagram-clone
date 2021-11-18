@extends('layouts.app')
@push('custom-css')
<link href="{{asset('css/showPhoto.css')}}" rel="stylesheet">
@endpush
@section('title')
{{$post->user->name}} on Instagram
@endsection
@livewireStyles
@section('content')

     @include('includes.navbar')
   <section class="py-5">
     <div class="container w-75 py-5">
     <div class="card" >
        <div class="row">
          <div class="col-md-5">
            <img src="{{asset('images/posts/' . $post->image)}}" class="img-fluid rounded-start" alt="..." id="photo-show" >
          </div>
          <div class="col-md-7">
              <div class="card-body">
            <livewire:comment :id='$post->id'>
            </div>
          </div>
        </div>
      </div>
</div>
</section>




@livewireScripts

@endsection
