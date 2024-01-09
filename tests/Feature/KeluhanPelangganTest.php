<?php

namespace Tests\Feature;

use App\Models\KeluhanPelanggan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_keluhan_pelanggan()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->actingAs($user);
        
        $response = $this->get('/keluhanPelanggan');
        $response->assertStatus(200);
    }

    public function test_create_keluhan_pelanggan()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->actingAs($user);

        $keluhanPelanggan = KeluhanPelanggan::factory(1)->create([
            'user_id' => $user->id,
        ]);
        $keluhanPelanggan = $keluhanPelanggan[0];

        $response = $this->get('/keluhanPelanggan');
        $response->assertStatus(200);
        $response->assertViewHas('keluhanPelanggans', function($collection) use ($keluhanPelanggan) {
            return $collection->contains($keluhanPelanggan);
        });
    }

    public function test_show_keluhan_pelanggan()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->actingAs($user);

        $keluhanPelanggan = KeluhanPelanggan::factory(1)->create([
            'user_id' => $user->id,
        ]);
        $keluhanPelanggan = $keluhanPelanggan[0];

        $response = $this->get('/keluhanPelanggan/'.$keluhanPelanggan->id);
        $response->assertStatus(200);
    }

    public function test_update_keluhan_pelanggan()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->actingAs($user);

        $keluhanPelanggan = KeluhanPelanggan::factory(1)->create([
            'user_id' => $user->id,
        ]);
        $keluhanPelanggan = $keluhanPelanggan[0];
        $newData = [
            'nama' => 'John doe', 
            'email' => 'john@gmail.com',
            'nomor_hp' => '085670730141',
            'keluhan' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin lacinia, nibh nec euismod rutrum',
        ];

        $response = $this->put("/keluhanPelanggan/".$keluhanPelanggan->id, $newData);
        $response->assertStatus(200);
        $this->assertDatabaseHas('keluhan_pelanggans', array_merge(['id' => $keluhanPelanggan->id], $newData));
    }

    public function test_delete_keluhan_pelanggan()
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        $this->actingAs($user);

        $keluhanPelanggan = KeluhanPelanggan::factory(1)->create([
            'user_id' => $user->id,
        ]);
        $keluhanPelanggan = $keluhanPelanggan[0];

        $response = $this->delete('/keluhanPelanggan/'.$keluhanPelanggan->id);
        $this->assertDatabaseMissing('keluhan_pelanggans', ['id' => $keluhanPelanggan->id]);
    }
}
