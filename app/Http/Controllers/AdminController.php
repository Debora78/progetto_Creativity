<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //DASHBOARD
    //!Con la funzione dashboard() gestiamo la logica  dei dati da mostrare all'amministratore cioè tutti gli utenti che hanno fatto richiesta per diventare amministratori, revisori o redattori
   public function dashboard(){
    $adminRequests = User::where('is_admin', NULL)->get();
    $revisorRequests = User::where('is_revisor', NULL)->get();
    $writerRequests = User::where('is_writer', NULL)->get();
    return view('admin.dashboard', compact('adminRequests', 'revisorRequests', 'writerRequests'));
   }
   //SETADMIN
   public function setAdmin(User $user){
    $user->is_admin = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name amministratore");
   }
   //SETREVISOR
   public function setRevisor(User $user){
    $user->is_revisor = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name revisore");
   }
   //SETWRITER
   public function setWriter(User $user){
    $user->is_writer = true;
    $user->save();
    return redirect(route('admin.dashboard'))->with('message', "Hai reso  $user->name redattore");
   }
   //EDITTAG
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
   //DELETETAG
   public function deleteTag(Tag $tag){
    foreach($tag->articles as $article){
        $article->tags()->detach($tag);
    }
    $tag->delete();
    return redirect()->back()->with('message', 'Tag eliminato correttamente');
   }
   //EDITCATEGORY
   public function editCategory(Request $request, Category $category){
    $request->validate([
        'name' => 'required|unique:categories',
    ]);
    $category->update([
        'name' => strtolower($request->name),
    ]);

    return redirect()->back()->with('message', 'Categoria aggiornata correttamente');
   }
   //DELETECATEGORY
   public function deleteCategory(Category $category){
    $category->delete();
    return redirect()->back()->with('message', 'Categoria eliminata correttamente');
   }
   //STORECATEGORY
   public function storeCategory(Request $request){
    Category::create([
        
        'name' => strtolower($request->name),
    ]);

    return redirect()->back()->with('message', 'Categoria inserita correttamente');
   }
}
