@extends('layouts.app')
@section('title')
Edit Profile
@endsection
@push('custom-css')
<link href="{{asset('css/profile2.css')}}" rel="stylesheet">
@endpush
@livewireStyles
@section('content')

  @include('includes.navbar')
<section class="py-5">


<div  class="container py-5">
    <div class="row">

         <div class="col-md-4">
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action active">
                 Edit Profile
                </a>
                <!-- <a href="#" class="list-group-item list-group-item-action">Change Password</a> -->
                <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">Logout</a>

              </div>
         </div>
         <div class="col-md-8">
               <div class="container">
               <div class="row">
                    <div class="col-md-2">
                        <img class="edit-img preview-image" id="preview-image" src="{{asset('images/users/' . $user->avatar)}}" alt="">
                    </div>

                    <div class="col-md-10">
                        <h6 class="mt-2" style="font-weight: 700;">{{$user->username}}</h6>
                        <i type="button" id="popup" class="update-color" data-toggle="modal" data-target="#upload-popup">
                            Change Profile Photo
                        </i>
                    </div>

               </div>
            </div>

             <!-- Button trigger modal -->


  <!-- Modal -->
  <div class="modal fade" id="upload-popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">

        <div class="modal-body">

            <ul class="list-group text-center">

                <livewire:upload-image >

               <li class="list-group-item"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
              </ul>

        </div>

      </div>
    </div>
  </div>

            <div class="container py-4">
            <livewire:edit-form >
            </div>
        </div>



    </div>



</div>
</section>
@livewireScripts
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script>

    Livewire.on('fileChoosen', () => {
        let input = document.getElementById('upload-img');
        let file = input.files[0];
        let reader = new FileReader();

        reader.onload=function(e){
                window.Livewire.emit('imageUpload' , reader.result);
                let image = document.getElementsByClassName("preview-image");
                for (var x = 0 ; x < image.length ;x++) {
                      image[x].src = e.target.result;
                }
            }
            reader.readAsDataURL(file);
            $(document).ready(function(){
            // Open modal on page load
            $("#upload-popup").removeClass("in");
            $(".modal-backdrop").remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            $("#upload-popup").hide();
            });
        });

    Livewire.on('deletePhoto', () => {
        window.Livewire.emit('deleteImage');
        let image = document.getElementsByClassName("preview-image");
        for (var x = 0 ; x < image.length ;x++) {
                image[x].src = '{{asset('images/users/def.jpg')}} ';
        }

        $(document).ready(function(){
        // Open modal on page load
        $("#upload-popup").removeClass("in");
        $(".modal-backdrop").remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        $("#upload-popup").hide();


            });
        });

</script>
@endsection
