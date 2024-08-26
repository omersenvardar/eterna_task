<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Post;

class PostCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $post;

    /**
     * Create a new message instance.
     *
     * @param Post $post
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.post_created')
            ->subject('New Post Published: ' . $this->post->title)
            ->with([
                'postTitle' => $this->post->title,
                'postBody' => $this->post->body,
                'postUrl' => route('posts.show', $this->post->slug),
            ]);
    }
}
