<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

uses(DatabaseMigrations::class, DatabaseTransactions::class);

it('has page title', function () {
    $this->get('/')->assertSee('Realtime to-do app');
});

it('has todos api endpoint', function () {
    $response = $this->get('/api/todos');

    $response->assertStatus($response->getStatusCode());
});

test('Test empty response todos api endpoint', function () {
    $response = $this->get('/api/todos');

    assertEquals("[]", $response->getContent());
});

test('Test create To-Do item', function () {
    $this->withoutEvents();
    $todo = [
        'title' => 'New To-Do Item'
    ];
    $response = $this->post('/api/todos', $todo);
    assertEquals("added", json_decode($response->getContent()));
});

test('Test see To-Do item', function () {
    $todo = factory(App\Task::class)->create();
    $response = $this->get('/api/todos');
    $responseItem = json_decode($response->getContent())[0];
    assertEquals($todo->title, $responseItem->title);
});

test('Test see all To-Do items', function () {
    $items = 10;
    factory(App\Task::class, $items)->create();
    $response = $this->get('/api/todos');
    assertCount($items, json_decode($response->getContent()));
});

test('Test complete To-Do item', function () {
    $this->withoutEvents();
    $todo = factory(App\Task::class)->create();
    $response = $this->put("/api/todos/{$todo->id}/complete", ['completed' => !$todo->completed]);
    assertEquals("completed", json_decode($response->getContent()));
});

test('Test delete To-Do item', function () {
    $this->withoutEvents();
    $todo = factory(App\Task::class)->create();
    $response = $this->delete("/api/todos/{$todo->id}");
    assertEquals("deleted", json_decode($response->getContent()));
});
