@extends('layout')

@section('title', 'Nou Client')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou Client</h1>
<a href="{{ route('client_list') }}">&laquo; Torna</a>
<div style="margin-top: 20px">

    @if ($errors->any())
    <div style="color:red">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('client_new') }}" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="dni">Dni</label>
            <input type="text" name="dni" />
        </div>
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" />
        </div>
        <div>
            <label for="cognoms">Cognoms</label>
            <input type="text" name="cognoms" />
        </div>
        <div>
            <label for="dataN">dataN</label>
            <input type="date" name="dataN" value="{{ now()->format('Y-m-d') }}" class="form-control">
        </div>
        <div>
            <label for="imatge">Imatge</label>
            <input type="file" name="imatge">
        </div>
        <button type="submit">Crear Client</button>

    </form>
</div>
@endsection