<div class="comment-wrapper">
        <a href="#">
        <img src="images/Smile.png"  class="icon" alt="">
        </a>
        <form wire:submit.prevent="save"  style="display: inline-block; width: 100%">
            @csrf
            <input name="comment" wire:model='comment'
             type="text" class="comment-box" placeholder="Add a comment...">
            <button type="submit"class="comment-btn">Post</button>
        </form>
        @if (session()->has('message'))
        <div  style="bottom: -16px; left:0; font-weight:600; z-index:9999999;"
         class="alert alert-success position-fixed w-25">
            {{session('message')}}
        </div>
        @endif
</div>

