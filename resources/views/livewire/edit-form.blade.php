<div class="container py-4">

    <form wire:submit.prevent="edit">

      <div class="form-group py-2">
          <div class="row">
           <div class="col-md-2">
            <label class="m-2 form-labels">Name</label>
           </div>
           <div class="col-md-10">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            <input type="text" class="form-control" name="name"
            wire:model="name" value="{{old('name') ?? $user->name }}">
           </div>

      </div>
      </div>

      <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Username</label>
         </div>
         <div class="col-md-10">
            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="text" class="form-control"
          wire:model.lazy="username"
          name="username" value="{{old('username') ?? $user->username}}">
         </div>

    </div>
    </div>


    <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Email</label>
         </div>
         <div class="col-md-10">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="email" class="form-control"  wire:model.lazy="email" name="email" value="{{old('email') ?? $user->email}}">
         </div>

    </div>
    </div>

    <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Website</label>
         </div>
         <div class="col-md-10">
            @error('website') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="text" class="form-control"  wire:model.lazy="website" name="website" >
         </div>

    </div>
    </div>

    <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Bio</label>
         </div>
         <div class="col-md-10">
            @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="text" class="form-control"  wire:model.lazy="bio" name="bio" value="{{old('bio') ?? $user->bio}}" >

         </div>

    </div>
    </div>

    <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Phone</label>
         </div>
         <div class="col-md-10">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="number" class="form-control"  wire:model.lazy="phone" name="phone" value="{{old('phone') ?? $user->phone}}" >
         </div>

    </div>
    </div>

    <div class="form-group py-2">
        <div class="row">
         <div class="col-md-2">
          <label class="m-2 form-labels">Gender</label>
         </div>
         <div class="col-md-10">
            @error('gender') <span class="text-danger">{{ $message }}</span> @enderror
          <input type="text" class="form-control"  wire:model.lazy="gender" name="gender" value="{{old('gender') ?? $user->gender}}">
         </div>

    </div>
    </div>

      <div class="text-center">
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
      </div>

    </form>
  </div>
