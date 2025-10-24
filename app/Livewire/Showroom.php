<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;

class Showroom extends Component
{
    public $search='';
    public $order=[];
    public $data;
    public function render()
    {
        if($this->search==''){
            $this->data=Item::limit(20);
        }else{
            $this->data=Item::where('mark',$this->search)
                                ->orWhere('name','like','%'.$this->search.'%')
                                ->orderBy('name','asc')
                                ->limit(20);
        }
        return view('livewire.showroom');
    }
}
