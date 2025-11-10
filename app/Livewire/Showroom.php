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
       
        $n=0;
        foreach($this->order as $idx=>$orderItem){
           // dd($orderItem);
            if($orderItem['code']==$item->id){
                $orderItem['qty']=$orderItem['qty']+1;
                $n=1;
                $this->order[$idx]=$orderItem;
            }
        }
        if ($n==0){
            $this->order[]=[
                "code"=>$item->id,
                "name"=>$item->name,
                "price"=>$item->price_sell,
                "qty"=>1
            ];
    
        }
        
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
    public function changeOrderItem($id,$value){
        if((int)$value==0){

            $this->delOrderItem($id);

        }else{

            $this->order[$id]["qty"]=(int)$value;
        }
        //dd($this->order[$id]);
    }
    
    public function render()
    {
        if($this->search==''){
            $this->data=Item::select(['id','mark','name','qty','price_sell','price_buy'])->limit(10)->get();
        }else{
            $this->data=Item::select(['id','mark','name','qty','price_sell','price_buy'])->where('mark',$this->search)
                                ->orWhere('name','like','%'.$this->search.'%')
                                ->orderBy('name','asc')
                                ->get();
        }
        return view('livewire.showroom');
    }
}
