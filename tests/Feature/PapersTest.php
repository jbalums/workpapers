<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Papers; 

class PapersTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */ 

    /** @test */
    public function it_can_view_all_papers()
    {
        $folder = factory('App\Papers', 10)->create();
        $json = json_encode(Papers::all());
        $response = $this->get('/api/papers');
        $response->assertStatus(200);
        $response->assertSee($json);
    }

    /** @test */
    public function it_can_add_new_paper()
    {
        $folder = factory('App\Papers')->make();
        $response = $this->post('/api/papers', $folder->toArray());
        $response->assertStatus(200);
        $response->assertSee('Working Paper Succesfully Added');
    }

    /** @test */
    public function it_can_validate_empty_value_when_adding_new_paper()
    {
        $folder = factory('App\Papers', ['title' => null])->make();
        $response = $this->post('/api/papers', $folder->toArray());
        $response->assertStatus(400);
        $response->assertSee('errors');
    }

    /** @test */
    public function it_can_update_a_paper()
    {
        $paper = factory('App\Papers')->create();
        $toBeEdit = factory('App\Papers')->make();
        $response = $this->put('/api/papers/'.$paper->id, $toBeEdit->toArray());
        $response->assertStatus(200);
        $response->assertSee('Working Paper Succesfully Updated');
    } 

    /** @test */
    public function it_can_delete_paper()
    {
        $paper = factory('App\Papers')->create();
        $response = $this->delete('/api/papers/'.$paper->reference_code);
        $response->assertStatus(200);
        $response->assertSee('Working Paper Succesfully Deleted');
    }

    /** @test */
    public function it_can_check_delete_to_not_found_paper()
    {
        $response = $this->delete('/api/papers/ZZZ1000');
        $response->assertStatus(400);
        $response->assertSee('Working Paper not found');
    }

}
