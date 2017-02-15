<form action='/user/register' method='post'>
    {{ csrf_field() }}

    Email: <input type='text' disabled='true' value='{{ $user->email }}'><br>
    Display Name: <input type='text' name='display_name' value='{{ $user->display_name }}'><br>
    Avatar: <input type='text' name='avatar' value='{{ $user->avatar }}'><br>
    <input type='submit' value='Submit'> 
</form>
