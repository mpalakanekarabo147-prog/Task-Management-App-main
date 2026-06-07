<?php

namespace Tests\Feature;

use App\Models\CategoryKAL;
use App\Models\TaskKAL;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_team_member_task_assignment_is_forced_to_self()
    {
        $teamMember = User::factory()->teamMember()->create();
        $otherMember = User::factory()->teamMember()->create();
        $category = CategoryKAL::factory()->create();

        $response = $this->actingAs($teamMember)->post(route('tasks.store'), [
            'category_id' => $category->id,
            'assigned_to' => $otherMember->id,
            'title' => 'Prepare sprint notes',
            'description' => 'Collect blockers and summarize progress.',
            'tags' => 'planning, sprint',
            'priority' => 'medium',
            'status' => 'pending',
            'deadline' => now()->addDay()->toDateString(),
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Prepare sprint notes',
            'assigned_to' => $teamMember->id,
            'created_by' => $teamMember->id,
        ]);

        $this->assertDatabaseMissing('tasks', [
            'title' => 'Prepare sprint notes',
            'assigned_to' => $otherMember->id,
        ]);
    }

    public function test_admin_can_assign_task_to_any_team_member()
    {
        $admin = User::factory()->admin()->create();
        $teamMember = User::factory()->teamMember()->create();
        $category = CategoryKAL::factory()->create();

        $response = $this->actingAs($admin)->post(route('tasks.store'), [
            'category_id' => $category->id,
            'assigned_to' => $teamMember->id,
            'title' => 'Review deployment checklist',
            'description' => 'Confirm rollback and monitoring steps.',
            'tags' => 'release',
            'priority' => 'high',
            'status' => 'pending',
            'deadline' => now()->addDays(2)->toDateString(),
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('tasks', [
            'title' => 'Review deployment checklist',
            'assigned_to' => $teamMember->id,
            'created_by' => $admin->id,
        ]);
    }

    public function test_guest_role_cannot_access_categories()
    {
        $guest = User::factory()->guest()->create();

        $this->actingAs($guest)
            ->get(route('categories.index'))
            ->assertForbidden();
    }

    public function test_team_member_cannot_manage_users()
    {
        $teamMember = User::factory()->teamMember()->create();

        $this->actingAs($teamMember)
            ->get(route('users.index'))
            ->assertForbidden();
    }

    public function test_task_deadline_cannot_be_in_the_past()
    {
        $admin = User::factory()->admin()->create();
        $category = CategoryKAL::factory()->create();

        $response = $this->actingAs($admin)->from(route('tasks.create'))->post(route('tasks.store'), [
            'category_id' => $category->id,
            'title' => 'Invalid deadline task',
            'priority' => 'low',
            'status' => 'pending',
            'deadline' => now()->subDay()->toDateString(),
        ]);

        $response->assertRedirect(route('tasks.create'));
        $response->assertSessionHasErrors('deadline');
        $this->assertDatabaseMissing('tasks', ['title' => 'Invalid deadline task']);
    }
}
