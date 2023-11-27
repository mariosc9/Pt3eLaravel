@extends('layout')

@section('title', 'Llistat de comptes')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Estadístiques</h1>

@if (session('status'))
<div>
  <strong>Success!</strong> {{ session('status') }}
</div>
@endif

<table style="margin-top: 20px;margin-bottom: 10px;">

  <h1>Compte amb saldo màxim</h1>
  <thead>
    <tr>
      <th>Codi</th>
      <th>Saldo</th>
      <th>Client</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $maximSaldo->codi}}</td>

      <td>{{ $maximSaldo->saldo }}</td>

      @isset($maximSaldo->client)
      <td>{{ $maximSaldo->client->nomCognoms() }}</td>
      @endisset
    </tr>
  </tbody>

</table>

<table style="margin-top: 20px;margin-bottom: 10px;">

  <h1>Compte amb saldo mínim</h1>
  <thead>
    <tr>
      <th>Codi</th>
      <th>Saldo</th>
      <th>Client</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>{{ $minimSaldo->codi}}</td>

      <td>{{ $minimSaldo->saldo }}</td>

      @isset($minimSaldo->client)
      <td>{{ $minimSaldo->client->nomCognoms() }}</td>
      @endisset
    </tr>
  </tbody>

</table>

<table style="margin-top: 20px;margin-bottom: 10px;">

  <h1>Total Comptes</h1>
  <thead>
    <tr>
      <th>Saldo Promig</th>
      <th>Quantitat Comptes</th>
    </tr>
  </thead>
  <tbody>

    <tr>
      <td>{{ $avgSaldo }}</td>
      <td>{{ $numComptes}}</td>
    </tr>
  </tbody>

</table>

<br>
@endsection