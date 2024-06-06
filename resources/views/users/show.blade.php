@extends('layouts.global')

@section('title', 'Usuario ' . $user->name)

@section('content')


    <div class="bg-light p-5 rounded">

        <h1> Bienvenido {{ $user->name }}</h1>

        <h1>Perfil de {{ $user->name }} - <strong class="d-inline-block mb-2 text-primary">{{ $user->id }}</strong>
        </h1>

        <p class="lead">Este es tu espacio personal dentro de nuestra página web, puedes:</p>
        <a class="btn btn-lg btn-primary" href="{{ route('users.edit', $user) }}" role="button">Actualizar tu perfil</a>
        <a class="btn btn-lg btn-outline-secondary" href="/docs/5.0/components/navbar/" role="button">Ir a tu calendario</a>
    </div>


    <div class="bg-light p-5 rounded">

        <h2 class="pb-3">Tareas asignadas</h2>
        <ul class="list-group">
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Titulo de la tarea</h5>
                    <small class="text-muted">12/05/24 - 16/05/24</small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <form action="" method="POST">

                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
                <small>Administrador</small>
                <span class="badge bg-primary rounded-pill">Grupo</span>
            </li>
            <li class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Titulo de la tarea</h5>
                    <small class="text-muted">12/05/24 - 16/05/24</small>
                </div>
                <div class="d-flex w-100 justify-content-between">
                    <p class="mb-1">Some placeholder content in a paragraph.</p>
                    <form action="" method="POST">

                        @csrf

                        @method('delete')

                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
                <small>Administrador</small>
                <span class="badge bg-primary rounded-pill">Grupo</span>
            </li>
        </ul>
    </div>
    <div class="bg-light p-5 rounded">

        <div class="d-flex justify-content-end pt-5">
            <form action="{{ route('users.destroy', $user) }}" method="POST">

                @csrf

                @method('delete')

                <button type="submit" class="btn btn-danger">Eliminar usuario</button>
            </form>
        </div>
    </div>

@endsection
