@extends('layout.standard')

@section('content')
<form action='/user/register' method='post' class='form-horizontal'>
    <fieldset>
        {{ csrf_field() }}
        
        <legend>Profile</legend>
        <p>Before you can start playing, you need to finish setting up your account.</p>

        <div class="form-group">
            <label for="email" class="col-lg-2 control-label">Email</label>
            <div class="col-lg-10">
                <input class="form-control" id="email" type="text" disabled value="{{ $user->email }}">
            </div>
        </div>
        <div class="form-group">
            <label for="display_name" class="col-lg-2 control-label">Display Name</label>
            <div class="col-lg-10">
                <input class="form-control" id="display_name" name="display_name" placeholder="Display Name" type="text" value="{{ $user->display_name }}">
            </div>
        </div>
        <div class="form-group">
            <label for="avatar" class="col-lg-2 control-label">Avatar URL</label>
            <div class="col-lg-10">
                <input class="form-control" id="avatar" placeholder="Avatar URL" type="text" value="{{ $user->avatar }}">
            </div>
        </div>        
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </fieldset>
</form>
@endsection
