
@extends('layouts.app')

@section('content')
<div class="jumbotron text-center title m-b-md">
    <h1>Laratter</h1>
    <div class="links">
        @foreach ($links as $link => $text)
        <a href="{{ $link }}">{{$text}} </a>
        @endforeach
    </div>
</div>

<div class="row">
    <form action="/messages" method="post"  enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group @if($errors->has('message')) has-danger @endif">
            <input type="text" name="message" class="form-control" placeholder="¿Qué estas pensando?">
            @if($errors->has('message'))
                @foreach ($errors->get('message') as $error)
                    <div class="form-control-feedback">{{$error}}</div>
                @endforeach
            @endif
            <input type="file" class="form-control-file" name="image">
        </div>
    </form>
</div>

<div class="row">
    @if(isset($messages))
    @forelse($messages as $message)
        <div class="col-6">
            @include('messages.message')
        </div>
    @empty
        <p>No hay mensajes destacados.</p>
    @endforelse

    @if(count($messages))
    <div class="mt-2 mx-auto">
        {{ $messages->links('pagination::bootstrap-4') }}
    </div>
    @endif

    @else
        <div class="col">
            <h1>No hay mensajes para mostrar</h1>
        </div>
    @endif
</div>


@endsection
