<?php
namespace Tests\Browser;

use App\Models\Sentence;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SentenceCrudTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_it_can_create_view_edit_and_delete_a_sentence()
    {
        $this->browse(function (Browser $browser) {

            // 🔹 INDEX
            $browser->visit('/')
                    ->assertSee('Todas as Frases');

            // 🔹 CREATE
            $browser->visit('/sentences/create')
                    ->assertSee('Nova Frase')
                    ->select('date', random_int(1, 7))
                    ->type('content', 'Frase de teste')
                    ->type('author', 'Papa Leão')
                    ->press('Salvar')
                    ->assertPathIs('/sentences/1')
                    ->assertSee('Frase de teste Dusk');

            // 🔹 SHOW
            $browser->assertSee('Papa Leão');

            // 🔹 EDIT
            $browser->visit('/sentences/1/edit')
                    ->assertSee('Editar Frase')
                    ->select('date', 2)
                    ->type('content', 'Frase editada de teste')
                    ->type('author', 'Ronaldo Fenomeno')
                    ->press('Salvar')
                    ->assertPathIs('/sentences/1')
                    ->assertSee('Frase editada de teste');

            // 🔹 DELETE
            $browser->press('Deletar')
                    ->assertPathIs('/sentences')
                    ->assertDontSee('Frase editada de teste');
        });
    }
}