@extends('layout')

@section('title', 'Editar Client')

@section('stylesheets')
@parent
@endsection

@section('content')
<h1>Edit Client</h1>
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

  <form method="POST" action="{{ route('client_edit', ['id' => $client->id]) }}" enctype="multipart/form-data">
    @csrf
    <div>
      <label for="dni">Dni</label>
      <input type="text" name="dni" value="{{ $client->dni }}">
    </div>
    <div>
      <label for="nom">Nom</label>
      <input type="text" name="nom" value="{{ $client->nom }}">
    </div>
    <div>
      <label for="cognoms">Cognoms</label>
      <input type="text" name="cognoms" value="{{ $client->cognoms }}">
      <div>
        <label for="dataN">DataN</label>
        <input type="date" name="dataN" value="{{ $client->dataN->format('Y-m-d') }}">
      </div>

      <td>
        @if ($client->imatge)
        <p>Imatge actual: <strong>{{$client->imatge}}</strong></p>
        <div>
          <label for="esborrarImatge">Esborrar Imatge</label>
          <input type="checkbox" name="esborrarImatge">
        </div>
        @endif

      </td>

      <div>
        <label for="imatge">Carrega una imatge</label>
        <input type="file" name="imatge">
      </div>
      <button type="submit">Modificar Client</button>
  </form>
</div>
@endsection