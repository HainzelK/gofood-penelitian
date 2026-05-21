<?php

namespace Tests\Feature;

use App\Models\Restoran;
use App\Models\Menu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RestoranTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test listing restaurants and filtering by jenis.
     */
    public function test_can_list_and_filter_restaurants(): void
    {
        // Create sample restaurants
        $resto1 = Restoran::create([
            'Nama' => 'Resto HF 1',
            'Jenis' => 'HF'
        ]);

        $resto2 = Restoran::create([
            'Nama' => 'Resto TGGL 1',
            'Jenis' => 'TGGL'
        ]);

        // Get all restaurants
        $response = $this->getJson('/restaurants');
        $response->assertStatus(200)
                 ->assertJsonCount(2, 'data')
                 ->assertJsonFragment(['Nama' => 'Resto HF 1'])
                 ->assertJsonFragment(['Nama' => 'Resto TGGL 1']);

        // Filter by HF
        $responseHF = $this->getJson('/restaurants?jenis=HF');
        $responseHF->assertStatus(200)
                   ->assertJsonCount(1, 'data')
                   ->assertJsonFragment(['Nama' => 'Resto HF 1'])
                   ->assertJsonMissing(['Nama' => 'Resto TGGL 1']);

        // Filter by TGGL
        $responseTGGL = $this->getJson('/restaurants?jenis=TGGL');
        $responseTGGL->assertStatus(200)
                     ->assertJsonCount(1, 'data')
                     ->assertJsonFragment(['Nama' => 'Resto TGGL 1'])
                     ->assertJsonMissing(['Nama' => 'Resto HF 1']);
    }

    /**
     * Test listing menus of a restaurant.
     */
    public function test_can_list_menus_by_restaurant(): void
    {
        $resto = Restoran::create([
            'Nama' => 'Resto A',
            'Jenis' => 'HF'
        ]);

        $menu1 = Menu::create([
            'NamaMenu' => 'Nasi Goreng',
            'Harga' => 20000,
            'IdResto' => $resto->idrestoran
        ]);

        $menu2 = Menu::create([
            'NamaMenu' => 'Es Teh',
            'Harga' => 5000,
            'IdResto' => $resto->idrestoran
        ]);

        $response = $this->getJson("/restaurants/{$resto->idrestoran}/menus");
        $response->assertStatus(200)
                 ->assertJsonPath('restaurant.Nama', 'Resto A')
                 ->assertJsonCount(2, 'data')
                 ->assertJsonFragment(['NamaMenu' => 'Nasi Goreng'])
                 ->assertJsonFragment(['NamaMenu' => 'Es Teh']);
    }

    /**
     * Test restaurant not found.
     */
    public function test_returns_404_for_non_existent_restaurant(): void
    {
        $response = $this->getJson('/restaurants/999/menus');
        $response->assertStatus(404)
                 ->assertJson(['status' => 'error', 'message' => 'Restoran not found']);
    }
}
