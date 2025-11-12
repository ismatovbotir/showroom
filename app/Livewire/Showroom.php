<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;

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
        //dd($this->order);
    }
    public function changeOrderItem($id,$value){
        if((int)$value==0){
            
            $this->delOrderItem($id);

        }else{

            if(((int)$value)<0){
                $newValue=-(int)$value;
            }else{
                $newValue=(int)$value;
            }
            $this->order[$id]["qty"]=$newValue;
        }
        //dd($this->order[$id]);
    }
    public function saveOrder(){
        $newOrder=Order::create();
        //dd($newOrder);
        foreach($this->order as $item){
            //dd($item);
            OrderItem::create(
                [
                    "order_id"=>$newOrder->id,
                    "item_id"=>$item["code"],
                    "qty"=>$item["qty"],
                    "price"=>$item["price"],
                    "comment"=>"test"
                ]
            );

        }
        $this->printReciept($newOrder->id);
        $this->order=[];
    }

    public function printReciept($id=1){

        try {
            // Указываем IP и порт принтера
            $connector = new NetworkPrintConnector("192.168.1.199", 9100,2);
        
            $printer = new Printer($connector);
        
            // Пример чека
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->setTextSize(2, 2);
            $printer->text("ShowRoom\n");
            $printer->text("Buyurtma №-".$id."\n");
            $printer->feed();
            $printer->text("========================");
            //$printer->setJustification(Printer::JUSTIFY_LEFT);
            foreach($this->order as $item){
                //dd($item);
                //$line = sprintf("%-12s %2d x %6s\n", mb_substr($item['name'], 0, 40),"",$item['qty']);
                $printer->setJustification(Printer::JUSTIFY_LEFT);
                $printer->setTextSize(1, 1);
                $printer->text($this->formatline($item['name'])."\n");
                $printer->setJustification(Printer::JUSTIFY_RIGHT);
                $printer->setTextSize(3, 3);
                $printer->text($item['qty']."\n");
                $printer->setTextSize(2, 2);
                $printer->text("------------------------");

            }
            $printer->text("========================");
           
            $printer->feed(2);
        
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->qrCode("http://".env('SRV_IP')."/order/".$id, Printer::QR_ECLEVEL_L, 6); 
            $printer->cut();
        
            $printer->close();
        
        } catch (\Exception $e) {
            //dd( "Ошибка печати: " . $e->getMessage());
        }
    }

    public function formatline($text){

        if(strlen($text)>24){
            return mb_substr($text,0,40);

        }else{
           
            return $text;
        }

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
