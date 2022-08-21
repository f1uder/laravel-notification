<?php

namespace Nrox\LaravelNotification\Http\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class Notification extends Component
{
    /**
     * @var int
     */
    public int $timer = 3000;

    /**
     * @var string
     */
    public string $position = 'tr';

    /**
     * @var array
     */
    public array $notices = [];

    public function mount()
    {
        $this->timer = config('notification.timer');
        $this->position = config('notification.position');

        if (Session::has('notifications')) {
            foreach (Session::get('notifications') as $notification) {
                $notice = [
                    'message' => $notification['message'],
                    'type' => $notification['type'] ?? 'info',
                    'timer' => $notification['timer'] ?? $this->timer,
                ];

                if (isset($notification['title'])) {
                    $notice['title'] = $notification['title'];
                }

                $this->notices[] = $notice;
            }

            Session::forget('notifications');
        }
    }

    public function render(): View
    {
        return view('laravel-notification::notice');
    }
}
