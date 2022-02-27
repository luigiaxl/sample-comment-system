<?php

namespace Tests\Feature;

use App\Models\Comment;
use DateTime;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Confirm that a new comment must contain the user's name.
     *
     * @return void
     */
    public function test_a_new_comment_must_have_user_name()
    {
        $data = Comment::factory()->make([ 'name' => null ])->toArray();
        
        $response = $this->postJson(route('comments.store'), $data);

        $response->assertUnprocessable()
            ->assertInvalid('name');
    }

    /**
     * Confirm that a new comment must contain the comment's text content.
     */
    public function test_a_new_comment_must_have_a_content()
    {
        $data = Comment::factory()->make([ 'content' => null ])->toArray();

        $response = $this->postJson(route('comments.store'), $data);

        $response->assertUnprocessable()
            ->assertInvalid('content');
    }

    /**
     * When a user's name and comment content exists, a new comment will be stored.
     * Should return the new comment data.
     */
    public function test_user_can_store_comment_with_name_and_content()
    {
        $data = Comment::factory()->make()->toArray();

        $response = $this->postJson(route('comments.store'), $data);

        $response->assertOk()
            ->assertJsonFragment([
                'name' => $data['name'],
                'content' => $data['content'],
            ]);
    }

    public function test_a_reply_to_non_existent_comment_will_fail()
    {
        $nonExistentCommentId = 9999;
        $data = Comment::factory()->make()->toArray();

        $response = $this->postJson(route('reply.store', ['comment' => $nonExistentCommentId]), $data);

        $response->assertNotFound()
            ->assertInvalid('comment_id');
    }

    public function test_a_reply_with_valid_comment_id_will_be_successful()
    {
        $comment = Comment::factory()->create();
        $data = Comment::factory()->make()->toArray();

        $response = $this->postJson(route('reply.store', ['comment' => $comment->id]), $data);

        $response->assertOk()
            ->assertJsonFragment([
                'name' => $data['name'],
                'content' => $data['content'],
                'comment_id' => $comment->id,
            ]);
    }

    public function test_a_user_can_fetch_list_of_comments()
    {
        Comment::factory()
            ->count(10)
            ->sequence(function ($comment) {
                $date = $this->faker->dateTime();

                return [
                    'created_at' => $date,
                    'updated_at' => $date,
                ];
            })
            ->create();

        $response = $this->getJson(route('comments.fetch'));

        $response->assertOk()
            ->assertJsonCount(10);
    }
}
