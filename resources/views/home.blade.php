@extends('layouts.app')

@section('content')
 <!-- Идёт проверка роли пользователя -->
@if(  Auth::user()->role === App\User::ROLE_ADMIN)

<a href="admin"><button>Войти</button></a>
@else
<a href="manageofproduction"><button>Войти</button></a>
@endif
@endsection
