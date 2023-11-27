@extends('layout')

@section('title', 'Editar Compte')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Edit Compte</h1>
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

    <form method="POST" action="{{ route('compte_edit', ['id' => $compte->id]) }}">
        @csrf
        <div>
            <label for="codi">Codi</label>
            <input type="text" name="codi" value="{{ $compte->codi }}">
        </div>
        <div>
            <label for="saldo">Saldo</label>
            <input type="number" name="saldo" value="{{ $compte->saldo }}">
        </div>
        <div>
            <label for="client_id">Client</label>
            <select name="client_id">
                <option value=""> Selecciona un client </option>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}" @selected($compte->client_id == $client->id) > {{ $client->nom }} {{ $client->cognoms }}</option>
                @endforeach
            </select>

        </div>
        <button type="submit">Modificar Compte</button>
    </form>
</div>
@endsection