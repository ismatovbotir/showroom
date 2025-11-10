<div class="row g-4">
      
      <!-- LEFT COLUMN: All items -->
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title mb-3">Available Items</h5>

            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Search by name, code, or mark..." wire:model.live="search">
            </div>

            <div class="table-container">
              <table class="table table-hover align-middle">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Code</th>
                    <th scope="col">Mark</th>
                    <th scope="col">Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price 1</th>
                    <th scope="col">Price 2</th>
                    <th scope="col" class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                @forelse($data as $item)
                <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->mark}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->price_buy}}</td>
                        <td>{{$item->price_sell}}</td>
                        <td class="text-end"><button class="btn btn-sm btn-outline-primary" wire:click="addItem({{$item->id}})">Add</button></td>
                    </tr>
                @empty
                    
                @endforelse
                    
                  
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: Selected items -->
      <div class="col-md-4">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title mb-3">Selected Items</h5>

            <div class="table-container">
              <table class="table table-sm table-bordered align-middle">
                <thead class="table-light">
                  <tr>
                    <th>Name</th>
                    <th>Qty</th>
                   
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                @forelse($order as $idx=>$orderItem)
                  <tr>
                    <td>{{$orderItem['name']}}</td>
                    <td><input type="number" class="form-control form-control-sm" value="{{$orderItem['qty']}}" wire:change='changeOrderItem({{$idx}},$event.target.value)'></td>
                   
                    <td class="text-end"><button class="btn btn-sm btn-outline-danger" wire:click="delOrderItem({{$idx}})">Delete</button></td>
                  </tr>
                  @empty
                    
                @endforelse 
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

    </div>
