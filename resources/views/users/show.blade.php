@extends('layouts.global')

@section('title', 'Usuario ' . $user->name)

@section('content')

    @error('msg')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
    @enderror

    <div class="bg-light p-5 rounded">
        @if (Auth::user()->id == $user->id)
            <h1> Bienvenido {{ $user->name }}</h1>
        @elseif (Auth::user()->admin)
            <h1>Perfil de {{ $user->name }} - <strong class="d-inline-block mb-2 text-primary">{{ $user->id }}</strong>
            </h1>
        @endif

        @if (Auth::user()->id == $user->id)
            <p class="lead">Este es tu espacio personal dentro de nuestra página web, puedes:</p>
            <a class="btn btn-lg btn-primary" href="{{ route('users.edit', $user) }}" role="button">Actualizar tu perfil</a>
            <a class="btn btn-lg btn-outline-dark" href="{{ route('calendar.show', $user->id) }}" role="button">Ir a tu
                calendario</a>
        @elseif (Auth::user()->admin)
            <p class="lead">Administración de usuario</p>
            <a class="btn btn-lg btn-primary" href="{{ route('users.edit', $user) }}" role="button">Editar perfil</a>
            <a class="btn btn-lg btn-outline-dark" href="{{ route('calendar.show', $user->id) }}"
                role="button">Revisar Calendario</a>
        @endif


    </div>


    <div class="bg-light p-5 rounded">

        <div class="row">
            <div class="col">
                <h2 class="pb-3">Tareas asignadas</h2>
            </div>
            <div class="col">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('tasks.create', $user->id) }}" type="button" class="btn btn-success btn-lg"><i
                            class="fa-solid fa-plus"></i> Tarea</a>
                </div>
            </div>
        </div>
        <ul class="list-group">
            @forelse ($tasks as $task)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <h5 class="mb-1">{{ $task->name }}
                                @if (isset($task->groupOfTask->name))
                                    <a href="{{ route('groups.show', $task->groupOfTask) }}" type="button"
                                        class="btn btn-outline-primary">
                                        {{ $task->groupOfTask->name }}
                                    </a>
                                @endif
                        </div>
                        <small class="text-muted"> {{ $task->created_at }} </small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <p class="mb-1">{{ $task->description }}</p>
                        <form action="{{ route('users.deleteTask', ['user' => $user, 'taskId' => $task->id]) }}"
                            method="POST">

                            @csrf

                            @method('delete')

                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i><span class="sr-only">Eliminar tarea</span></button>
                        </form>
                    </div>
                    <span class="badge text-bg-primary rounded-pill"><i class="fa-regular fa-calendar"></i>
                        Fecha</span>
                    <small> <i class="fa-solid fa-clock text-success "></i> {{ $task->start }} <i
                            class="fa-solid fa-arrow-right"></i> <i class="fa-regular fa-clock text-danger"></i>
                        {{ $task->end }}</small>

                </li>
            @empty
                <p>No hay tareas.</p>
            @endforelse
        </ul>
    </div>
    <div class="bg-light p-5 rounded">

        <div class="row">
            <div class="col">
                <small>Los grupos solo te los puede asignar el administrador</small>
                <h2 class="pb-3">Grupos asignados</h2>
            </div>
        </div>
        <ul class="list-group">
            @forelse ($groups as $group)
                <li class="list-group-item">
                    <div class="d-flex w-100 justify-content-between">
                        <div>
                            <h5 class="mb-1">{{ $group->name }}</h5>
                        </div>
                        <a href="{{ route('groups.show', $group) }}" type="button"
                        class="btn btn-outline-primary">Ver grupo
                    </a>
                    @if (Auth::user()->admin)
                        <form action="{{ route('groups.deleteUser', ['user' => $user, 'groupId' => $group->id]) }}"
                            method="POST">

                            @csrf

                            @method('delete')

                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i><span class="sr-only">Eliminar usuario</span></button>
                        </form>
                    </div>
                    @endif
                </li>
            @empty
                <p>No hay grupos.</p>
            @endforelse
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
