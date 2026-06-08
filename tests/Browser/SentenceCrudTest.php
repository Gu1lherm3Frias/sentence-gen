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
		
		//Spatie auth fix
		$permissions = ['admin', 'boss', 'manager', 'poweruser', 'user'];
		foreach ($permissions as $permission) {
			\Spatie\Permission\Models\Permission::findOrCreate($permission, 'senhaunica');
		}

        $this->browse(function (Browser $browser) {

			//index
			$browser->visit('/')
					->assertSee('Todas as Frases');

			$browser->assertSee('Entrar')
					->clickLink('Entrar')
					->assertSee('Senhaunica-faker')
					->type('loginUsuario', '123456')
					->press('Login')
					->assertSee('123456@usp.br')
					->assertSee('Todas as Frases');


			//create
            $browser->visit('/sentences/create')
					->assertSee('123456@usp.br')
					->assertSee('Nova Frase')
					->select('date', random_int(1, 7))
					->type('content', 'Frase de teste Dusk')
					->type('author', 'Papa Leão')
					->press('Salvar')
					->pause(2000)
					->assertSee('Frase de teste Dusk')
					->assertSee('Papa Leão');

            // show
            $browser->assertSee('Papa Leão');

            // edit
            $browser->visit('/sentences/1/edit')
					->assertSee('123456@usp.br')
					->assertSee('Editar Frase')
					->select('date', 2)
					->type('content', 'Frase editada de teste')
					->type('author', 'Ronaldo Fenomeno')
					->press('Salvar')
					->assertPathIs('/sentences/1')
					->assertSee('Frase editada de teste');

            // delete
            $browser->press('Deletar')
					->assertSee('123456@usp.br')
                    ->assertPathIs('/')
                    ->assertDontSee('Frase editada de teste');
        });
    }
}