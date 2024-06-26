@extends('layouts.global')

@section('title', 'Usuarios ')

@section('content')
    <h1>Administrar grupos</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('groups.create') }}" type="button" class="btn btn-success btn-lg"><i
                class="fa-solid fa-plus"></i> Grupo</a>
    </div>
    <div class="my-3 p-3 bg-white rounded box-shadow">
        @foreach ($groups as $group)
            <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <strong class="text-gray-dark">{{ $group->name }}</strong>
                        <a href="{{ route('groups.show', $group->id) }}"><i class="fa-solid fa-user-group fa-3x"></i><span class="sr-only">Ver el grupo {{ $group->name }}</span></a>
                    </div>
                    <span class="d-block">{{ $group->email }}</span>
                </div>
            </div>
        @endforeach

        <small class="d-block text-right mt-3">
            {{ $groups->links() }}
        </small>
    </div>


@endsection
