<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Inseriamo le nuove colonne di tipo booleano che gestiranno i ruoli degli Utenti. Dopo concateniamo altri metodi after() con cui decidiamo il posizionamento delle colonne nella tabella 'users', con nullable() diciamo che le colonne possono avere valore NULL, con default() diciamo che le colonne hanno valore di default in questo caso sarà: false.
        //Direttamente nella funzione up() creiamo un nuono utente con (nome, email e password criptata) che avrà il ruolo di admin
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->after('email')->nullable()->default(false);
            $table->boolean('is_revisor')->after('is_admin')->nullable()->default(false);
            $table->boolean('is_writer')->after('is_revisor')->nullable()->default(false);
        });

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.it',
            'password' => bcrypt('12345678'),
            'is_admin' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    //Nella funzione down() prima cancelliamo l'utente admin e poi droppiamo le colonne
    public function down(): void
    {
        User::where('email', 'admin@admin.it')->delete();

        Schema::table('users', function (Blueprint $table) {
          $table->dropColumn(['is_admin', 'is_revisor', 'is_writer']);
        });
    }
};
