<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

use App\Models\Compte;
use App\Models\Client;

class CompteController extends BaseController
{
  use AuthorizesRequests, ValidatesRequests;

  function list()
  {
    /*  $comptes = Compte::all();  */

    $comptes = Compte::orderBy('saldo', 'desc')
      ->get();

    return view('compte.list', ['comptes' => $comptes]);
  }

  function new(Request $request)
  {
    $compte = new Compte;

    if ($request->isMethod('post')) {
      // recollim els camps del formulari en un objecte compte

      $request->validate([
        'codi' => ['required', 'unique:comptes', 'max:10'],
        'saldo' => ['required'],
      ]);

      $compte->codi = $request->codi;
      $compte->saldo = $request->saldo;
      $compte->client_id = $request->client_id;
      $compte->save();

      //dd($compte);
      return redirect()->route('compte_list')->with('status', 'Nou compte ' . $compte->codi . ' creat!')->cookie('client', $request->client_id, 60);
    }
    // si no venim de fer submit al formulari, hem de mostrar el formulari

    $clients = Client::all();
    $ultimClient = $request->cookie('client');
    return view('compte.new', ['clients' => $clients, 'ultimClient' => $ultimClient]);
  }

  function delete($id)
  {
    $compte = Compte::find($id);
    $compte->delete();

    return redirect()->route('compte_list')->with('status', 'Compte ' . $compte->codi . ' eliminat!');
  }

  function edit($id, Request $request)
  {
    $compte = Compte::find($id);

    if ($request->isMethod('post')) {

      $request->validate([
        'codi' => ['required', Rule::unique('comptes')->ignore($compte->id), 'max:10'],
        'saldo' => ['required'],
      ]);

      $compte->codi = $request->codi;
      $compte->saldo = $request->saldo;
      $compte->client_id = $request->client_id;
      $compte->save();
    }

    $clients = Client::all();

    return view('compte.edit', ['compte' => $compte, 'clients' => $clients]);
  }

  function search(Request $request)
  {
    $condicioCodi = $request->cercarCodi;
    $condicioSaldo = $request->cercarSaldo;
    $condicioCerca = $request->tipusCerca;

    if ($condicioCerca == 'CercaAND') {
      $comptes = Compte::where('codi', 'like', '%' . $condicioCodi . '%')->where('saldo', '>', $condicioSaldo)->get();
      return view('compte.list', ['comptes' => $comptes, 'condicio' => $condicioCodi, 'condicioSaldo' => $condicioSaldo]);
    } else if ($condicioCerca == 'CercaOR') {
      $comptes = Compte::where('codi', 'like', '%' . $condicioCodi . '%')->orWhere('saldo', '>', $condicioSaldo)->get();
      return view('compte.list', ['comptes' => $comptes, 'condicio' => $condicioCodi, 'condicioSaldo' => $condicioSaldo]);
    }
  }
  function maximSaldo()
  {
    $maximSaldo = Compte::orderBy('saldo', 'desc')->first();
    $minimSaldo = Compte::orderBy('saldo', 'asc')->first();
    $numComptes = Compte::count();
    $avgSaldo = round(Compte::avg('saldo'), 2);
    return view('compte.estadistiques', ['maximSaldo' => $maximSaldo, 'minimSaldo' => $minimSaldo, 'numComptes' => $numComptes, 'avgSaldo' => $avgSaldo]);
  }
}
