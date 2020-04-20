@extends('layouts.dracula');

@section('content')
<form action="{{ route('settings.password.update') }}" method="POST">
    @csrf
    <label for="current_password">
    <input type="password" name="current_password" id="current_password" value="{{  }}">
    </label>
</form>
@endsection
