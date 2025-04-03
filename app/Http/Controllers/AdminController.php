<?php

namespace App\Http\Controllers;

use App\Models\Tag;
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

   public function setAdmin(User $user){
    $user->is_admin = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name amministratore");
   }

   public function setRevisor(User $user){
    $user->is_revisor = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name revisore");
   }

   public function setWriter(User $user){
    $user->is_writer = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name redattore");
   }

   //!Con la funzione editTag() abbiamo specificato non solo che è necessario inserire un valore, ma anche che nella tabella non ci può essere un altro tag con lo stesso nome. Poi prendiamo ciò che inserisce l'utente nell'input, lo trasformiamo in lowercase e lo aggiorniamo nel database e aggiorniamo il tag già presente.
   public function editTag(Request $request, Tag $tag){
    $request->validate([
        'name' => 'required|unique:tags',
    ]);
    $tag->update([
        'name' => strtolower($request->name),
    ]);

    return redirect()->back()->with('message', 'Tag aggiornato correttamente');
   }

   public function deleteTag(Tag $tag){
    foreach($tag->articles as $article){
        $article->tags()->detach($tag);
    }
    $tag->delete();
    return redirect()->back()->with('message', 'Tag eliminato correttamente');
   }
}
