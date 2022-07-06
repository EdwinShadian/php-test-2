<?php

namespace Tests\Unit;

use App\Models\Notebook\Notebook;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NotebookControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testIndex()
    {
        $response = $this->call('GET', 'api/v1/notebook');
        $this->assertArrayHasKey('data', $response);
        $response = $this->call('GET', 'api/v1/notebook', ['page' => 1]);
        $this->assertArrayHasKey('data', $response);
        $this->assertLessThanOrEqual(10, count($response->original));
    }

    public function testStore()
    {
        $note = Notebook::factory()->makeOne()->toArray();
        $response = $this->postJson('/api/v1/notebook', $note);
        $response->assertCreated();
        $note['name'] = null;
        $response = $this->postJson('/api/v1/notebook', $note);
        $response->assertStatus(400);
    }

    public function testShow()
    {
        Notebook::factory()->createOne(['id' => 1]);
        $response = $this->call('GET', 'api/v1/notebook/1');
        $response->assertOk();
        $response->assertJsonStructure(['data' => ['name',
            'company',
            'phone_number',
            'email',
            'birthdate',
            'photo']]);
        $response = $this->call('GET', 'api/v1/notebook/2');
        $response->assertNotFound();
    }

    public function testUpdate()
    {
        Notebook::factory()->createOne(['id' => 1]);
        $note = Notebook::factory()->makeOne(['id' => 1])->toArray();
        $response = $this->patchJson('api/v1/notebook/1', $note);
        $response->assertOk();
        $responseResource = $response->getOriginalContent()['data']->resource->toArray();
        unset($responseResource['deleted_at']);
        $this->assertEquals($note, $responseResource);
    }

    public function testDestroy()
    {
        Notebook::factory()->createOne(['id' => 1]);
        $response = $this->call('DELETE', 'api/v1/notebook/1');
        $response->assertNoContent();
        $response = $this->call('DELETE', 'api/v1/notebook/2');
        $response->assertNotFound();
    }
}
