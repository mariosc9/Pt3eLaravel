<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;

use App\Models\Compte;
use App\Models\Client;

class ClientController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  function list()
  {
    $clients = Client::all();

    return view('client.list', ['clients' => $clients]);
  }

  function new(Request $request)
  {
    if ($request->isMethod('post')) {

      $request->validate([
        'dni' => ['required', 'unique:clients', 'size:9'],
        'nom' => ['required'],
        'cognoms' => ['required'],
        'dataN' => ['required', 'before_or_equal:today'],
      ]);

      $client = new Client;
      $client->dni = $request->dni;
      $client->nom = $request->nom;
      $client->cognoms = $request->cognoms;
      $client->dataN = $request->dataN;

      if ($request->file('imatge')) {
        $file = $request->file('imatge');
        $filename = $client->nom . '_' . $client->cognoms . "." . $file->extension();

        //guardem en una variable $filename el nom que posarem al fitxer
        $file->move(public_path('uploads/imatges'), $filename);
        $client->imatge = $filename;
      }

      $client->save();

      return redirect()->route('client_list')->with('status', 'Nou client ' . $client->dni . ' creat!');
    }
    return view('client.new');
  }

  function delete($id)
  {
    $client = Client::find($id);
    $client->delete();

    return redirect()->route('client_list')->with('status', 'Client ' . $client->dni . ' eliminat!');
  }

  function edit($id, Request $request)
  {
    $client = Client::find($id);

    if ($request->isMethod('post')) {

      $request->validate([
        'dni' => ['required', Rule::unique('clients')->ignore($client->id), 'max:10'],
        'nom' => ['required'],
        'cognoms' => ['required'],
        'dataN' => ['required', 'before_or_equal:' . now()->format('d-m-Y')],
      ]);

      $client->dni = $request->dni;
      $client->nom = $request->nom;
      $client->cognoms = $request->cognoms;
      $client->dataN = $request->dataN;

      if ($request->file('imatge')) {
        //guardem en una variable $filename el nom que posarem al fitxer

        $file = $request->file('imatge');
        $filename = $client->nom . '_' . $client->cognoms . "." . $file->extension();

        $file->move(public_path('uploads/imatges'), $filename);
        $client->imatge = $filename;
      }

      if (isset($request->esborrarImatge)) {
        $client->imatge = null;
        File::delete(public_path('uploads/imatges/' . $client->imatge));
      }

      $client->save();
    }
    return view('client.edit', ['client' => $client]);
  }
}
