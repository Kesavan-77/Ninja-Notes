<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $userName;
    public function __construct($user)
    {
        $this->userName = $user;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.user-profile')->with('user',$this->userName);
    }
}
