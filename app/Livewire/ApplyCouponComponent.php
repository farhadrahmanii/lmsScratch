<?php

namespace App\Livewire;

use Livewire\Component;

class ApplyCouponComponent extends Component
{
    public $search = '';
    public $id;

    public function render()
    {
        return view('livewire.apply-coupon-component');
    }
}
