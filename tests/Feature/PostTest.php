<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\BlogPost;

class PostTest extends TestCase
{

    use RefreshDatabase;

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'A New Blog Post';
        $post->content = 'A New Blog Post Content';
        $post->save();

        return $post;
    }

    public function testNoBlogPostTextWhenNoPostsInDatabase()
    {
        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('Sorry No Posts Yet!!!');
    }

    public function testSee1BlogPostWhenThereIs1Post()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        // Act
        $response = $this->get('/posts');

        // Assert
        $response->assertSeeText('A New Blog Post');

        $this->assertDatabaseHas('blog_posts',[
            'title'   => 'A New Blog Post',
            'content' => 'A New Blog Post Content'
        ]);
    }

    public function testStoreValidPost()
    {
        // Arrange
        $params = [
            'title'   => 'A New Blog Post',
            'content' => 'New Blog Content'
        ];

        // Act Assert
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('Post created Successfully',session('status'));

    }

    public function testForFail()
    {
        // Arrange
        $params = [
            'title'   => 'New',
            'content' => 'New'
        ];

        // Act Assert
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('errors');

        // Grab error messages from the session
        $messages = session('errors')->getMessages();

        // Assert
        $this->assertEquals('The title must be at least 4 characters.', $messages['title'][0]);
        $this->assertEquals('The content must be at least 5 characters.', $messages['content'][0]);

    }

    public function testForUpdatedBlogPost()
    {
        // arrange
        $post = $this->createDummyBlogPost();

        // https://laravel.com/docs/7.x/upgrade#date-serialization
        // dd($post->toArray());
        // assert, check if the db has the above post
        $this->assertDatabaseHas('blog_posts', [
            'title'   => 'A New Blog Post',
            'content' => 'A New Blog Post Content'
        ]);

        // Arrange
        $params = [
            'title'   => 'Update the Blog Post',
            'content' => 'Update the Blog Content'
        ];

        // Act Assert
        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals('Post updated successfully!',session('status'));

        // Check that blog post was updated in the db
        $this->assertDatabaseMissing('blog_posts', [
            'title'   => 'A New Blog Post',
            'content' => 'A New Blog Post Content'
        ]);

        $this->assertDatabaseHas('blog_posts', $params);
    }

    public function testForDeletedBlogPost()
    {
        // Arrange
        $post = $this->createDummyBlogPost();

        $params = [
            'title'   => 'A New Blog Post',
            'content' => 'A New Blog Post Content'
        ];

        // Check for post in db
        $this->assertDatabaseHas('blog_posts', $params);

        // Act
        $this->delete("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        // Assert
        $this->assertEquals('Blog Post successfully deleted!',session('status'));

        // check for deletion of post
        $this->assertDatabaseMissing('blog_posts', $params);
    }
}
