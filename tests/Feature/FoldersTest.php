<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Folders; 

class FoldersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */  

    /** @test */
    public function it_can_view_all_folder()
    {
        $folder = factory('App\Folders', 10)->create();
        $json = json_encode(Folders::all());
        $response = $this->get('/api/folders');
        $response->assertStatus(200);
        $response->assertSee($json);
    }

    /** @test */
    public function it_can_add_new_folder()
    {
        $folder = factory('App\Folders')->make();
        $response = $this->post('/api/folders', $folder->toArray());
        $response->assertStatus(200);
        $response->assertSee('Folder Succesfully Added');
    }
    /** @test */
    public function it_can_validate_empty_value_when_adding_new_folder()
    {
        $folder = factory('App\Folders', ['name' => null])->make();
        $response = $this->post('/api/folders', $folder->toArray());
        $response->assertStatus(400);
        $response->assertSee('errors');
    }
    /** @test */
    public function it_can_update_a_folder()
    {
        $folder = factory('App\Folders')->create();
        $toBeEdit = factory('App\Folders')->make();
        $response = $this->put('/api/folders/'.$folder->id, $toBeEdit->toArray());
        $response->assertStatus(200);
        $response->assertSee('Folder Succesfully Updated');
    }

    /** @test */
    public function it_can_validate_empty_value_when_adding_update_folder()
    {
        $folder = factory('App\Folders')->create();
        $response = $this->put('/api/folders/'.$folder->id, []);
        $response->assertStatus(400);
        $response->assertSee('errors');
    }

    /** @test */
    public function it_can_delete_folder()
    {
        $folder = factory('App\Folders')->create();
        $response = $this->delete('/api/folders/'.$folder->id);
        $response->assertStatus(200);
        $response->assertSee('Folder Succesfully Deleted');
    }
    /** @test */
    public function it_can_check_delete_to_not_found_folder()
    {
        $response = $this->delete('/api/folders/100');
        $response->assertStatus(400);
        $response->assertSee('Folder not found');
    }
    /** @test */
    public function it_can_view_all_working_paper_under_this_folder()
    {
        $folder = factory('App\Folders')->create();
        factory('App\Papers', 10, ['folder_id' => $folder->id])->create();
        $response = $this->get('/api/folders/'.$folder->id. '/getpapers');
        $response->assertStatus(200);
    }
}
