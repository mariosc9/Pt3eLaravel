@extends('layout')

@section('title', 'Nou Compte')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Nou Compte</h1>
<a href="{{ route('compte_list') }}">&laquo; Torna</a>
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

    <form method="POST" action="{{ route('compte_new') }}">
        @csrf
        <div>
            <label for="codi">Codi</label>
            <input type="text" name="codi" />
        </div>
        <div>
            <label for="saldo">Saldo</label>
            <input type="number" name="saldo" />
        </div>
        <div>
            <label for="client_id">Client</label>
            <select name="client_id">
                <option value=""> Selecciona un client </option>

                @foreach ($clients as $client)

                <option value="{{ $client->id }}" @selected($client->id == $ultimClient)> {{ $client->nom }} {{ $client->cognoms }}</option>

                @endforeach

            </select>
        </div>
        <button type="submit">Crear Compte</button>
    </form>
</div>
@endsection