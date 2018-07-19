<?php

namespace Tests\Feature\Route;

use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PersonTest extends TestCase
{

    protected $personMock;

    public function setUp()
    {
        parent::setUp();
        $this->personMock = Mockery::mock('App\Models\Person');
        $this->personMock
            ->shouldReceive('getAttribute')
            ->with('id')
            ->andReturn(1);
        $this->personMock
            ->shouldReceive('getAttribute')
            ->with('name')
            ->andReturn('Jessie');
        $this->personMock
            ->shouldReceive('getAttribute')
            ->with('height')
            ->andReturn(1.73);
        $this->personMock
            ->shouldReceive('getAttribute')
            ->with('weight')
            ->andReturn(59.0);
        $this->personMock
            ->shouldReceive('getAttribute')
            ->andReturn(null);
    }

    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    public function testPersonList()
    {
        $response = $this->json('GET', 'api/person');
        $response->assertStatus(200);
    }

    public function testPersonStore()
    {
        $response = $this->json('POST', 'api/person',
            [
                'name' => 'Johnny',
                'weight' => '60',
                'height' => '1.72'
            ]);
        $response->assertStatus(200);
    }

    public function testPersonView()
    {
        $response = $this->json('GET', 'api/person/1');
        $response->assertStatus(200);
    }

    public function testPersonUpdate()
    {
        $response = $this->json('PUT', 'api/person/1', ['name' => 'Johnson']);
        $response->assertStatus(200);
    }

    public function testPersonDelete()
    {
        $response = $this->json('DELETE', 'api/person/1');
        $response->assertStatus(200);
    }
}
