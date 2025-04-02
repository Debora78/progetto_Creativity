<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //!Con la funzione dashboard() gestiamo la logica  dei dati da mostrare all'amministratore cioè tutti gli utenti che hanno fatto richiesta per diventare amministratori, revisori o redattori
   public function dashboard(){
    $adminRequest = User::where('is_admin', NULL)->get();
    $revisorRequest = User::where('is_revisor', NULL)->get();
    $writerRequest = User::where('is_writer', NULL)->get();
    return view('admin.dashboard', compact('adminRequest', 'revisorRequest', 'writerRequest'));
   }
}
