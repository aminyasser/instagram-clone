<div>

    <li class="list-group-item">
        <label style="cursor: pointer; " name="avatar" class="update-color des-pop mr-5" for="upload-img">
           Upload Photo
        </label>
       <input accept="image/jpeg,image/png,image/jpg" class="form-control-file" name="avatar"  id="upload-img"
       wire:model="image" wire:change="$emit('fileChoosen')"
       type="file">
     </li>
     <li class="list-group-item">
        <a href=""
        style="font-weight: 600;" wire:click.prevent="$emit('deletePhoto')" class="des-pop text-danger">
        Remove Current Photo
     </a>
    </li>
</div>
