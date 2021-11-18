@extends('layouts.app')
@section('title')
New Post
@endsection
@push('custom-css')
<link href="{{asset('css/NewPost.css')}}" rel="stylesheet">
@endpush
@livewireStyles
@section('content')

    @include('includes.navbar')
<section class="py-5">
<div class="container py-5">

    <livewire:add-post>

</div>
</section>
@livewireScripts
<script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
<script>


    Livewire.on('delete', () => {
        let container =  document.querySelector(".upload-photo");
           container.style.display = "none";
           window.Livewire.emit('deleteTmpUrl');
            let control =$("#upload-image");
            control.val("");
    });
    Livewire.on('checkHashtag', () => {

        let regex = /[#|@](\w+)(?<=[^ ])$/ig;
        let content =  $(".caption-place").val();
        let hash = content.match(regex);
        console.log(hash);
        if (hash != null) {
        window.Livewire.emit('getHash' , hash[0]);
        }else  {
        $('.hash-box').hide();
        window.Livewire.emit('unsetTag');
        }

    })
    Livewire.on('addHash', tagId => {
        window.Livewire.emit('unsetTag');
        let id = 'hash-' + tagId;
        let regex = /[#|@](\w+)$/ig;
        var value = $.trim($('#'+id).text());
        var oldContent = $('.caption-place').val();
        var newContent = oldContent.replace(regex, "");
        $('.caption-place').val(newContent+value+' ');
        $('.caption-place').focus();
    })
    window.livewire.on('alert_remove',()=>{
    setTimeout(function(){ $(".alert-success").fadeOut('fast');
    }, 3000); // 3 secs
    });

    document.body.onkeyup = function(e){
    if(e.keyCode == 32){
        $('.hash-box').hide();
    }
    }

</script>
@endsection
