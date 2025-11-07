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
    public $data=[];

    
    
    public function addItem(Item $item){
       
        $this->order[]=[
            "code"=>$item->id,
            "name"=>$item->name,
            "price"=>$item->price_sell,
            "qty"=>1
        ];

        //dd($this->order);
    }
    public function delOrderItem($id){
        $tempOrder=[];
        foreach($this->order as $idx=>$item){
            if($id!=$idx){
                $tempOrder[]=$item;
            }

        }
        $this->order=$tempOrder;
    }
    
    public function render()
    {
        if($this->search==''){
            $this->data=Item::select(['id','mark','name','qty','price_sell','price_buy'])->limit(10)->get();
        }else{
            $this->data=Item::where('mark',$this->search)
                                ->orWhere('name','like','%'.$this->search.'%')
                                ->orderBy('name','asc')
                                ->limit(20)->get();
        }
        return view('livewire.showroom');
    }
}
