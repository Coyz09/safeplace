<form method="POST">
    @csrf

    <input type="hidden" name="id" value="{{ $user[0]['id']}}">
    <input type="password" name="password" placeholder="New password">
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Confirm password">
    <br><br>
    <input type="submit">

</form>
