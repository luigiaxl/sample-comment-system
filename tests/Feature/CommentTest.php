<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Confirm that a new comment must container the user's name.
     *
     * @return void
     */
    public function test_a_new_comment_must_have_user_name()
    {
        $response = $this->postJson('/comments', Comment::factory()->make([ 'name' => null ])->toArray());

        $response->assertUnprocessable();
    }
}
