@extends('layouts.app')

@section('content')
<div style="text-align:center;">


    <section  style="text-align:center;" class="jumbotron text-center">
        <div class="container">
        <h1 class="jumbotron-heading">Добро пожаловать {{Auth::user()->name}} </h1>
    </section>

    <!-- Идёт проверка роли пользователя -->
    @if(  Auth::user()->role === App\User::ROLE_ADMIN)

    <a href="admin">
    @elseif( Auth::user()->role === App\User::ROLE_MANAGE_OF_PRODUCTION )
    <a href="manageofproduction">
    @elseif( Auth::user()->role === App\User::ROLE_SHOPPER )
    <a href="shopper">
    @endif      
    <button class="btn btn-secondary">Войти</button></a>
            
    </a>
    

</div>
@endsection
