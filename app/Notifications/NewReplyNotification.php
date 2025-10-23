<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Notifications\NewReviewNotification;

class NewReplyNotification extends Notification
{
    use Queueable;
    protected string $replierName;
    protected ?int $productId; // nullable int
    protected ?string $productImage;


    public function __construct(string $replierName, ?int $productId, ?string $productImage = null)
    {
        $this->replierName = $replierName;
        $this->productId = $productId;
        $this->productImage = $productImage;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        $url = $this->productId
            ? route('users.prodsDetails', ['id' => $this->productId]) . '#reviews-section'
            : null;

        return [
            'message' => "{$this->replierName} replied to your review.",
            'product_image' => $this->productImage,
            'url' => $url,
        ];
    }
}
