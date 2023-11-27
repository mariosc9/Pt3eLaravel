@extends('layout')

@section('title', 'Llistat de clients')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Llistat de clients</h1>

@if (Auth::check())
<a href="{{ route('client_new') }}">+ Nou client</a>
@endif

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table style="margin-top: 20px;margin-bottom: 10px;">
    <thead>
        <tr>
            <th>Dni</th>
            <th>Nom</th>
            <th>Cognoms</th>
            <th>DataN</th>
            <th>Imatge</th>
            <th>Quantitat Comptes</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($clients as $client)

        <tr>
            <td>{{ $client->dni}}</td>

            <td>{{ $client->nom }}</td>

            <td>{{ $client->cognoms }}</td>

            <td>{{ $client->dataN->format('d-m-Y') }}</td>

            <td>
                @if ($client->imatge)
                <img src="{{ asset('uploads/imatges/' . $client->imatge) }}" alt="">
                @endif
            </td>

            <td>
                {{count($client->comptes)}}
            </td>

            @if (Auth::check())
            <td>
                <a href="{{ route('client_delete', ['id' => $client->id]) }}">Eliminar<br></a>
                <a href="{{ route('client_edit', ['id' => $client->id]) }}">Editar client</a>
            </td>

            @endif

        </tr>

        @endforeach


    </tbody>
</table>

<br>
@endsection