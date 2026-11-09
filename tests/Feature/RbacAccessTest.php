<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Database\Seeders\RoleAndPermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RbacAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    public function test_staf_cannot_delete_mahasiswa(): void
    {
        $staf = User::where('email', 'staf@its.ac.id')->firstOrFail();
        $mahasiswa = Mahasiswa::create([
            'nrp' => '5025249999',
            'nama' => 'Mahasiswa Uji',
            'email' => 'mahasiswa.ujicoba@student.its.ac.id',
            'departemen_id' => 'IF',
            'is_active' => true,
        ]);

        $this->actingAs($staf)
            ->delete(route('admin.mahasiswa.destroy', $mahasiswa))
            ->assertForbidden();

        $this->assertDatabaseHas('mahasiswas', ['id' => $mahasiswa->id]);
    }

    public function test_admin_can_delete_mahasiswa(): void
    {
        $admin = User::where('email', 'admin@its.ac.id')->firstOrFail();
        $mahasiswa = Mahasiswa::create([
            'nrp' => '5025249998',
            'nama' => 'Mahasiswa Hapus',
            'email' => 'mahasiswa.hapus@student.its.ac.id',
            'departemen_id' => 'IF',
            'is_active' => true,
        ]);

        $this->actingAs($admin)
            ->delete(route('admin.mahasiswa.destroy', $mahasiswa))
            ->assertRedirect(route('admin.mahasiswa.index'));

        $this->assertDatabaseMissing('mahasiswas', ['id' => $mahasiswa->id]);
    }
}
