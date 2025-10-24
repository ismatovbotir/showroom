<div class="row g-4">
      
      <!-- LEFT COLUMN: All items -->
      <div class="col-md-8">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h5 class="card-title mb-3">Available Items</h5>

            <div class="mb-3">
              <input type="text" class="form-control" placeholder="Search by name, code, or mark...">
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
                    <li>{{ $user->name }}</li>
                @empty
                    <tr>
                        <td>1001</td>
                        <td>A01</td>
                        <td>Apple</td>
                        <td>120</td>
                        <td>$1.00</td>
                        <td>$0.80</td>
                        <td class="text-end"><button class="btn btn-sm btn-outline-primary">Add</button></td>
                    </tr>
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
                    <th>Price</th>
                    <th class="text-end">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><input type="text" class="form-control form-control-sm" value="Apple"></td>
                    <td><input type="number" class="form-control form-control-sm" value="5"></td>
                    <td><input type="text" class="form-control form-control-sm" value="1.00"></td>
                    <td class="text-end"><button class="btn btn-sm btn-outline-danger">Delete</button></td>
                  </tr>
                  <tr>
                    <td><input type="text" class="form-control form-control-sm" value="Banana"></td>
                    <td><input type="number" class="form-control form-control-sm" value="10"></td>
                    <td><input type="text" class="form-control form-control-sm" value="0.60"></td>
                    <td class="text-end"><button class="btn btn-sm btn-outline-danger">Delete</button></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>

    </div>
