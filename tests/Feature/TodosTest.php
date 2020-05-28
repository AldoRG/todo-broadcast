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

test('Test create todo item', function () {
    $this->withoutEvents();
    $todo = [
        'title' => 'New todo Item'
    ];
    $response = $this->post('/api/todos', $todo);
    assertEquals("added", json_decode($response->getContent()));
    $this->assertDatabaseHas('tasks', ['title' => $todo['title']]);
});

test('Test see todo item', function () {
    $todo = factory(App\Task::class)->create();
    $response = $this->get('/api/todos');
    $responseItem = json_decode($response->getContent())[0];
    assertEquals($todo->title, $responseItem->title);
});

test('Test see all todo items', function () {
    $items = 10;
    factory(App\Task::class, $items)->create();
    $response = $this->get('/api/todos');
    assertCount($items, json_decode($response->getContent()));
});

test('Test complete todo item', function () {
    $this->withoutEvents();
    $todo = factory(App\Task::class)->create();
    $response = $this->put("/api/todos/{$todo->id}/complete");
    assertEquals("completed", json_decode($response->getContent()));
    $this->assertDatabaseHas('tasks', ['title' => $todo['title'], 'completed' => true]);
});

test('Test delete todo item', function () {
    $this->withoutEvents();
    $todo = factory(App\Task::class)->create();
    $response = $this->delete("/api/todos/{$todo->id}");
    assertEquals("deleted", json_decode($response->getContent()));
    $this->assertDatabaseMissing('tasks', ['title' => $todo['title'], 'completed' => true]);
});
