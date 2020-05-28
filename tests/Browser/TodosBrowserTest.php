<?php

namespace Tests\Browser;

use App\Task;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TodosBrowserTest extends DuskTestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;
    /**
     * A Dusk test See title.
     *
     * @return void
     */
    public function testSeeTitle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertTitle('Realtime to-do app')
                ->assertSee('todos');
        });
    }

    public function testCreateTodoItem()
    {
        $this->withoutEvents();
        $todo = factory(Task::class)->make();

        $this->browse(function ($browser) use ($todo) {
            $browser->visit('/')
                ->assertDontSee($todo->title)
                ->type('@todo-input', $todo->title)
                ->keys('@todo-input', '{enter}')
                ->waitForText($todo->title)
                ->assertSee($todo->title);
        });
    }

    public function testCompleteTodoItem()
    {
        $this->withoutEvents();
        $todo = factory(Task::class)->create();

        $this->browse(function ($browser) use ($todo) {
            $browser->visit('/')
                ->type('@todo-input', $todo->title)
                ->keys('@todo-input', '{enter}')
                ->waitForText($todo->title)
                ->assertSee($todo->title)
                ->waitFor('.todo')
                ->assertSee($todo->title)
                ->check('@check-todo' . $todo->id)
                ->assertChecked('@check-todo' . $todo->id);
        });
    }
}
