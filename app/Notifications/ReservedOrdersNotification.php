<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\Users\products;
use App\Notifications\NewReviewNotification;

class ReservedOrdersNotification extends Notification
{
    use Queueable;

    protected $productId;
    protected $buyerName;
    protected $productTitle;
    protected $productImage;

    public function __construct($buyerName, $productTitle, $productImage = null, $productId = null)
    {
        $this->buyerName = $buyerName;
        $this->productTitle = $productTitle;
        $this->productImage = $productImage;
        $this->productId = $productId;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->buyerName} has reserved your product: {$this->productTitle}.",
            'product_image' => $this->productImage,
            'url' => route('notifications.open', ['id' => $this->id]),
        ];
    }
}
