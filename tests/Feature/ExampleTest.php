<?php

namespace Tests\Feature;

use App\Todo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testBasicTest()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
//
//    public function testBasicExample()
//    {
//        $this->visit('/clinical/login')
//            ->see('Laravel 5');
//    }

/**
    public function testUser(){
        factory(Todo::class,3)->create();
        factory(Todo::class,3)->create(['priorty'=>'3']);
        $importantTasks=factory(Todo::class)->create(['priorty'=>'3']);
        $tasks=Todo::priortize()->get();
        $this->assertEquals($importantTasks->id,$tasks->first()->id);
    }


    public function testBasicExample()
    {
        $response = $this->json('POST', '/user', ['name' => 'ahmad']);
        $response
            ->assertStatus(200)
            ->assertExactJson([
                'created' => true,
            ]);

    }

 ***/

//    public function testAvatarUpload()
//    {
//        Storage::fake('avatars');
//
//        $response = $this->json('POST', '/avatar', [
//            'avatar' => UploadedFile::fake()->image('avatar.jpg')
//        ]);
//
//        // Assert the file was stored...
//        Storage::disk('avatars')->assertExists('avatar.jpg');
//
//        // Assert a file does not exist...
//        Storage::disk('avatars')->assertMissing('missing.jpg');
//    }

}
