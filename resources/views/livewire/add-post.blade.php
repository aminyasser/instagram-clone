<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>
    <div class="upload-wrapper text-center position-relative">
        @if ($avatar)
                @php
                try {
                $url = $avatar->temporaryUrl();
                $photoStatus = true;
                }catch (RuntimeException $exception){
                    $this->photoStatus =  false;
                }
            @endphp
            @if($photoStatus)
        <div style="cursor: auto" class="upload-photo">
            <img id="post-image"style="top: 0; left:0"
            class="w-100 h-100 position-absolute"src="{{ $avatar->temporaryUrl() }}">

            <div class="icon-wrapper position-absolute">
                <i id="#upload-delete-tmp" wire:click="$emit('delete')" class="fas fa-times upload-delete"></i>
            </div>
        </div>
        @endif

        @endif
        <form class="mt-5"   wire:submit.prevent="save">
        <label for="upload-image" class="w-100">
        <div class="text-center py-5">

            <svg aria-label="Icon to represent media such as images or videos" class=""
            color="#262626" fill="#262626" height="77" role="img" viewBox="0 0 97.6 77.3" width="96">
            <path d="M16.3 24h.3c2.8-.2 4.9-2.6 4.8-5.4-.2-2.8-2.6-4.9-5.4-4.8s-4.9 2.6-4.8 5.4c.1 2.7 2.4 4.8 5.1 4.8zm-2.4-7.2c.5-.6 1.3-1 2.1-1h.2c1.7 0 3.1 1.4 3.1 3.1 0 1.7-1.4 3.1-3.1 3.1-1.7 0-3.1-1.4-3.1-3.1 0-.8.3-1.5.8-2.1z" fill="currentColor"></path><path d="M84.7 18.4L58 16.9l-.2-3c-.3-5.7-5.2-10.1-11-9.8L12.9 6c-5.7.3-10.1 5.3-9.8 11L5 51v.8c.7 5.2 5.1 9.1 10.3 9.1h.6l21.7-1.2v.6c-.3 5.7 4 10.7 9.8 11l34 2h.6c5.5 0 10.1-4.3 10.4-9.8l2-34c.4-5.8-4-10.7-9.7-11.1zM7.2 10.8C8.7 9.1 10.8 8.1 13 8l34-1.9c4.6-.3 8.6 3.3 8.9 7.9l.2 2.8-5.3-.3c-5.7-.3-10.7 4-11 9.8l-.6 9.5-9.5 10.7c-.2.3-.6.4-1 .5-.4 0-.7-.1-1-.4l-7.8-7c-1.4-1.3-3.5-1.1-4.8.3L7 49 5.2 17c-.2-2.3.6-4.5 2-6.2zm8.7 48c-4.3.2-8.1-2.8-8.8-7.1l9.4-10.5c.2-.3.6-.4 1-.5.4 0 .7.1 1 .4l7.8 7c.7.6 1.6.9 2.5.9.9 0 1.7-.5 2.3-1.1l7.8-8.8-1.1 18.6-21.9 1.1zm76.5-29.5l-2 34c-.3 4.6-4.3 8.2-8.9 7.9l-34-2c-4.6-.3-8.2-4.3-7.9-8.9l2-34c.3-4.4 3.9-7.9 8.4-7.9h.5l34 2c4.7.3 8.2 4.3 7.9 8.9z"
             fill="currentColor"></path>
             <path d="M78.2 41.6L61.3 30.5c-2.1-1.4-4.9-.8-6.2 1.3-.4.7-.7 1.4-.7 2.2l-1.2 20.1c-.1 2.5 1.7 4.6 4.2 4.8h.3c.7 0 1.4-.2 2-.5l18-9c2.2-1.1 3.1-3.8 2-6-.4-.7-.9-1.3-1.5-1.8zm-1.4 6l-18 9c-.4.2-.8.3-1.3.3-.4 0-.9-.2-1.2-.4-.7-.5-1.2-1.3-1.1-2.2l1.2-20.1c.1-.9.6-1.7 1.4-2.1.8-.4 1.7-.3 2.5.1L77 43.3c1.2.8 1.5 2.3.7 3.4-.2.4-.5.7-.9.9z"
              fill="currentColor"></path></svg>
        </div>
        <div class="py-5">
            <label for="upload-image" class="w-100 btn-custom">
            <p class="btn btn-primary w-25 btn-custom" >
                 Choose Photo
            </p>
        </label>
        </div>
    </label>
    <input  accept="image/jpeg,image/png,image/jpg"  type="file" class="form-control" wire:model='avatar' name="avatar" id="upload-image">
    </div>

    @error('avatar')
    <div class="container w-75 pt-2">
    <div class="alert alert-danger">{{ $message }}</div>
     </div>
    @enderror
    @error('caption')
    <div class="container w-75 pt-2">
        <div class="alert alert-danger">{{ $message }}</div>
    </div>
    @enderror
    <div class="my-3 m-auto textarea-handle position-relative">
        <textarea type="text" class="form-control caption-place" name="caption" wire:model.lazy='caption'
            wire:keyup='$emit("checkHashtag")'  placeholder="Write Caption"></textarea>
            <div class="hash-box position-absolute pb-2" wire:loading.class.delay='opacity-75'>
                @foreach (collect($tags) as $tag )
                    <div  wire:click='$emit("addHash" , {{$tag->id}})'
                        class="row p-3 hash-wrapper w-100">
                        <div id="hash-{{$tag->id}}" class="col-md-12">
                            <i class="d-block search-username hash-value">{{ '#'.$tag->hashtag}}</i>
                        </div>
                        <div style="font-size: 12px; font-weight:600" class="col-md-6">
                            {{$tag->posts->count()}} posts
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary w-75 m-auto btn-custom">Share</button>
    </div>

    </form>




</div>


