<?php

namespace App\Listeners;

use App\Events\PostPublished;
use App\Models\Subscription;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\View;

class SendPostNotification
{
    /**
     * Handle the event.
     *
     * @param  PostPublished  $event
     * @return void
     */
    public function handle(PostPublished $event)
    {
        $post = $event->post;

        $subscribers = Subscription::where('user_id', $post->user_id)
            ->where('status', 'active')
            ->get();

        foreach ($subscribers as $subscriber) {
            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->SMTPAuth   = true;
                $mail->Host       = env('MAIL_HOST');
                $mail->Username   = env('MAIL_USERNAME');
                $mail->Password   = env('MAIL_PASSWORD');
                $mail->SMTPSecure = env('MAIL_ENCRYPTION');
                $mail->Port       = env('MAIL_PORT');

                $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                $mail->addAddress($subscriber->email);

                $mail->isHTML(true);
                $mail->Subject = 'There is a new post!';

                $emailContent = View::make('emails.post_notification', [
                    'post' => $post,
                    'subscription' => $subscriber
                ])->render();

                $mail->Body    = $emailContent;
                $mail->AltBody = strip_tags($emailContent);

                $mail->send();
            } catch (Exception $e) {
                error_log('Mailer Error: ' . $mail->ErrorInfo);
            }
        }
    }
}
