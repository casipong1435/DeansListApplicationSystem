<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;


class Notification extends Component
{

    public $user;
    public $notifications;

    public function mount(){
        $this->user = auth()->user();
    }

    public function render()
    {
        $unread_notifications = $this->user->unreadNotifications()->count();

        $this->notifications = $this->user->notifications;

        return view('livewire.notification', ['unread_notifications' => $unread_notifications, 'notifications' => $this->notifications]);
    }

    public function deleteAllNotification(){
        $notifications = $this->user->notifications;
        
        foreach ($notifications as $notification){
            $notification->delete();
        }
    }

    public function deleteNotification($id){
        $decrypted_id = Crypt::decrypt($id);
        $notification = $this->user->notifications->where('id', $decrypted_id)->first();
        $notification->delete();
    }

    public function markAsReadNotification($id){
        $decrypted_id = Crypt::decrypt($id);

        $notification = $this->user->notifications->find($decrypted_id)->first();
        $notification->markAsRead();
    }
    
}
