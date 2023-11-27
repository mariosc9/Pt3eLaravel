@extends('layout')

@section('title', 'Llistat de comptes')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Llistat de comptes</h1>
@if (Auth::check())
<a href="{{ route('compte_new') }}">+ Nou compte</a><br>
@endif

@if (session('status'))
<div>
    <strong>Success!</strong> {{ session('status') }}
</div>
@endif

@if(isset($condicioSaldo) || isset($condicio))
    <p1>Cercat per codi ... <strong>{{ $condicio }}</strong></p1><br>
    @if(isset($condicioSaldo) && isset($condicio))
        <p1>AND Mínim Saldo ... <strong>{{ $condicioSaldo }}</strong></p1><br>
    @elseif(isset($condicioSaldo) || isset($condicio))
        <p1>OR Mínim Saldo ... <strong>{{ $condicioSaldo }}</strong></p1><br>
    @endif
    <a href="{{ route('compte_list') }}">Netejar la cerca</a><br>
@endif


<table style="margin-top: 20px;margin-bottom: 10px;">
    <thead>
        <tr>
            <th>Codi</th>
            <th>Saldo</th>
            <th>Client</th>
        </tr>
    </thead>
    <tbody>


        @foreach ($comptes as $compte)

        <tr>
            <td>{{ $compte->codi}}</td>

            <td>{{ $compte->saldo }}</td>


            @isset($compte->client)
            <td>{{ $compte->client->nomCognoms() }}</td>
            @endisset

            @empty($compte->client)
            <td></td>
            @endempty

            @if (Auth::check())
            <td>
                <a href="{{ route('compte_delete', ['id' => $compte->id]) }}">Eliminar<br></a>
                <a href="{{ route('compte_edit', ['id' => $compte->id]) }}">Editar compte</a>
            </td>
            @endif
        </tr>
        @endforeach

    </tbody>

</table>

<form method="GET" action="{{ route('compte_cerca') }}">
    <div>
        <label for="cercarCodi">Cerca codi:</label>
        <input type="text" name="cercarCodi" required>
    </div>
    <div>
        <label for="cercarSaldo">Mínim saldo:</label>
        <input type="number" name="cercarSaldo" required>
    </div>
    <button type="submit" name="tipusCerca" value="CercaAND">Cerca AND</button>
    <button type="submit" name="tipusCerca" value="CercaOR">Cerca OR</button>
</form>

<br>
@endsection