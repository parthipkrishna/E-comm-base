@extends('layouts.dashboard')
@section('list-user')

    <!-- Pre-loader -->
    <div id="preloader">
        <div id="status">
            <div class="bouncing-loader">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order details</a></li>
                        <li class="breadcrumb-item active">Order detail</li>
                    </ol>
                </div>
                <h4 class="page-title">Order Details</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-11">
            @php
                $statuses = ['order placed', 'processing', 'shipped', 'delivered', 'cancelled'];
                // Get all statuses in this order
                $allStatuses = $order->orderitems->pluck('status');   
                // Find the "earliest" status (lowest in the sequence)
                $progressStatus = 'order placed'; // default
                foreach ($statuses as $status) {
                    if ($allStatuses->contains($status)) {
                        $progressStatus = $status;
                        break;
                    }
                }
            @endphp
            <div class="horizontal-steps mt-4 mb-4 pb-5" id="tooltip-container">
                <div class="horizontal-steps-content">
                    @foreach ($statuses as $step)
                        <div class="step-item
                            @if ($progressStatus == $step)
                                current
                            @elseif(array_search($step, $statuses) < array_search($progressStatus, $statuses))
                                completed
                            @endif
                        ">
                            <span>{{ ucfirst($step) }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="process-line" style="width:
                    @php
                        $progressIndex = array_search($progressStatus, $statuses);
                        echo $progressIndex !== false ? ($progressIndex * 33) . '%' : '0%';
                    @endphp
                ;"></div>
            </div>
        </div>
    </div>
    <div class="row mb-3 gap-0 align-items-end">
        {{-- Order Status Section --}}
        <div class="col-md-3">
            <div class="form-group">
                <label for="bulk-status" class="form-label">Order Status</label>
                <div class="d-flex gap-1">
                    <select class="form-select" id="bulk-status" style="max-width: 200px;" {{ in_array($order->order_status, ['delivered', 'cancelled']) ? 'disabled' : '' }}>
                        @foreach ($statuses as $status)
                            <option value="{{ $status }}" {{ $order->order_status == $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary" id="update-status-btn" {{ in_array($order->order_status, ['delivered', 'cancelled']) ? 'disabled' : '' }}>Update</button>
                </div>
            </div>
        </div>

        {{-- Payment Status Section --}}
        <div class="col-md-3">
            <form method="POST" action="{{ route('admin.payment.statusupdate', $order->id) }}">
                @csrf
                <div class="form-group">
                    <label for="bulk-status-payment" class="form-label">Payment Status</label>
                    <div class="d-flex gap-1">
                        <select class="form-select" name="payment_status" id="bulk-status-payment" style="max-width: 200px;" {{ in_array($order->order_status, ['delivered', 'cancelled']) ? 'disabled' : '' }} required>
                            @foreach ($paymentStatuses as $status)
                                <option value="{{ $status }}" {{ $order->payment_status == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary" {{ in_array($order->order_status, ['delivered', 'cancelled']) ? 'disabled' : '' }}>Update</button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Status Message --}}
        <div id="status-message" class="alert mt-2" style="display: none;"></div>
    </div>

    {{-- Optional message box --}}
    <div id="status-message" class="alert mt-2" style="display: none;"></div>
        <!-- Items table row -->
        <div class="row mt-3">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">   
                        <h4 class="header-title mb-3">Items from Order #{{ $order->order_number }}</h4>
                        <!-- Status update controls -->
                        <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th><input type="checkbox" id="select-all"></th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Tax Amount</th>
                                    <th>Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->orderitems as $item)
                                    <tr>
                                        <td><input type="checkbox" name="item_ids[]" class="item-checkbox" value="{{ $item->id }}"></td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ $item->unit_amount }}</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ $item->total_amount }}</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ $item->tax_amount }}</td>
                                        <td>{{ ucfirst($item->status) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-3">Order Summary</h4>

                        <div class="table-responsive">
                        @if ($order->orderItems->count() > 0)
                            <table class="table mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Description</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Grand Total :</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;"> {{ number_format($grandTotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Estimated Tax :</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;"> {{ number_format($estimatedTax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Payment Type :</td>
                                        <td>{{ $order->payment_type ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount :</td>
                                        <td><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;"> {{ $order->discount ?? 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total :</th>
                                        <th><img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;"> {{ number_format($finalTotal, 2) }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="text-muted">No data available.</p>
                        @endif
                        </div>
                        <!-- end table-responsive -->

                    </div>
                </div>
            </div> <!-- end col -->
        </div>               
        <!-- Shipping information row -->
        <d class="row mt-3">
            <div class="col-lg-4">
                <div class="card">
                    @php
                        $delivery = json_decode($order->delivery_address);
                    @endphp
                    <div class="card-body-info">
                        <h4 class="header-title mb-3">Shipping Information</h4>
                        <hr>
                        <h5>{{ $delivery->name ?? 'N/A' }}</h5>
                        <address class="mb-0 font-14 address-lg">
                            {{ $delivery->address ?? '' }}<br>
                            {{ $delivery->city ?? '' }}, {{ $delivery->state ?? '' }} {{ $delivery->zip ?? '' }}<br>
                        </address>
                        <p>
                            Phone: {{ $order->user->phone }}<br>
                            Email: {{ $order->user->email }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
        <div class="card">
            <div class="card-body-info">
                <h4 class="header-title mb-3">Billing Information</h4>
                <hr>
                <!-- Billing Address Field replaced with regular elements -->
                <div class="mb-0 font-14 address-lg">
                    <h5 class="mb-1">{{ $delivery->name ?? 'N/A' }}</h5>
                    <p class="mb-0">Payment Type: {{ $order->payment_type ?? '-' }}</p>
                    <p class="mb-0">Recieved Date: {{ $order->payment_received_date ?? '-' }}</p>
                    <p class="mb-0">Transaction ID: {{ $order->transaction_id ?? '-' }}</p>
                    <p class="mb-0">Payment Status: {{ $order->payment_status ?? '-' }}</p>
                    <p class="mb-0">
                        Attachment: 
                        @if($order->payment_attachment)
                            <a href="{{ Storage::url($order->payment_attachment) }}" 
                            target="_blank" 
                            class="text-primary">
                                View Attachment
                            </a>
                        @else
                            -
                        @endif
                    </p>
                    <h5>Total Amount: <img src="{{ asset('dashboard/assets/dirham-grey.png') }}" alt="AED" width="12" height="12" class="img-fluid " style="margin-bottom: 4px;">{{ number_format($finalTotal, 2) }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body-info">
                <h4 class="header-title mb-3">Delivery Info</h4>
                <div class="text-center">
                    <i class="mdi mdi-truck-fast h2 text-muted"></i>
                    <h5><b>UPS Delivery</b></h5>
                    <p class="mb-1"><b>Order ID :</b> {{ $order->order_number }}</p>
                    <p class="mb-0"><b>Payment Mode :</b> {{ $order->payment_type ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
     <!-- end col -->
     <div class="order-notes card shadow mb-4">
        <div class="row mb-2">
            <div class="col">
                <h3 class="mb-0">Notes</h3>
            </div>
            <div class="col-auto text-end mt-2">
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                    Add Note
                </button>
            </div>
        </div>

        @if($order->notes->count())
    <div class="container">
        <div class="row fw-bold border-bottom pb-2 mb-2">
            <div class="col-md-9"></div>
            <div class="col-md-2">Date</div>
            <div class="col-md-1 text-end">Action</div>
        </div>
        @foreach($order->notes as $note)
            <div class="row align-items-center border-bottom py-2">
                <div class="col-md-9">
                    {{ $note->note }}
                </div>
                <div class="col-md-2">
                    {{ $note->created_at->format('d-m-Y H:i') }}
                </div>
                <div class="col-md-1 text-end">
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#deleteNoteModal{{ $note->id }}">
                        <i class="mdi mdi-delete" style="color: darkcyan;"></i>
                    </a>
                </div>
            </div>

            <!-- Delete Modal -->
            <div id="deleteNoteModal{{ $note->id }}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="ri-information-line h1 text-info"></i>
                                <h4 class="mt-2">Heads up!</h4>
                                <p class="mt-3">Do you want to delete this note?</p>
                                <form action="{{ route('admin.notes.delete/{id}', $note->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger my-2">Delete</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <p>No notes available for this order.</p>
@endif

</div>



<!-- Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Add Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.notes.store', $order->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" name="note" id="note" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Note</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Shipping Info Modal -->
<div class="modal fade" id="shippingModal" tabindex="-1" aria-labelledby="shippingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.update.status.order', $order->id) }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Enter Shipping Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="order_status" value="shipped">
          <div class="mb-3">
            <label>Shipping Vendor</label>
            <input type="text" name="shipping_vendor" class="form-control" required>
          </div>
          <div class="mb-3">
            <label>Tracking Number</label>
            <input type="text" name="tracking_number" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update Order</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Payment Details Modal -->
<div class="modal fade" id="paymentDetailsModal" tabindex="-1" aria-labelledby="paymentDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.payment.update',$order->id) }}" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="paymentDetailsModalLabel">Enter Payment Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <input type="hidden" name="payment_status" value="Paid">
          <div class="mb-3">
            <label for="payment_method" class="form-label">Payment Method</label>
            <select class="form-select" name="payment_method"  style="max-width: 200px;" required>

              <option value="GPay">GPay</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Cheque">Cheque</option>
              <option value="Cash">Cash</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="transaction_id" class="form-label">Transaction ID</label>
            <input type="text" class="form-control" name="transaction_id" required>
          </div>

          <div class="mb-3">
            <label for="payment_received_date" class="form-label">Received Date</label>
            <input type="date" class="form-control" name="payment_received_date" value="{{ \Carbon\Carbon::now()->toDateString() }}" required>
          </div>

          <div class="mb-3">
            <label for="payment_attachment" class="form-label">Attachment (optional)</label>
            <input type="file" class="form-control" name="payment_attachment">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Submit Payment</button>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
</style>      
    <!-- end row -->
    <script>
document.addEventListener('DOMContentLoaded', function () {
  const statusDropdown = document.getElementById('bulk-status');
  const shippingModal = new bootstrap.Modal(document.getElementById('shippingModal'));

  statusDropdown.addEventListener('change', function () {
    const selectedStatus = statusDropdown.value;
    if (selectedStatus === 'shipped') {
      shippingModal.show();
      // Reset dropdown to prevent double update or accidental resubmit
      statusDropdown.selectedIndex = 0;
    }
  });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to show status messages
        function showStatusMessage(message, type = 'success') {
            const messageDiv = $('#status-message');
            messageDiv.removeClass('alert-success alert-danger alert-info')
                        .addClass(`alert-${type}`)
                        .text(message)
                        .fadeIn();
            
            // Hide message after 5 seconds
            setTimeout(() => messageDiv.fadeOut(), 5000);
        }

        // Select all checkbox functionality
        $('#select-all').click(function() {
            $('.item-checkbox').prop('checked', $(this).prop('checked'));
        });
        
        // Update status button click handler
        $('#update-status-btn').click(function () {
            var selectedItems = [];
            var currentStatuses = [];
            
            $('.item-checkbox:checked').each(function() {
                selectedItems.push($(this).val());
                currentStatuses.push($(this).closest('tr').find('td:last').text().trim().toLowerCase());
            });
            
            if (selectedItems.length === 0) {
                showStatusMessage('Please select at least one item to update.', 'danger');
                return;
            }
            
            var newStatus = $('#bulk-status').val();
            var token = '{{ csrf_token() }}';
            
            // Check if all selected items have the same status
            var allSameStatus = currentStatuses.length > 0 && 
                                currentStatuses.every(status => status === currentStatuses[0]);
            
            $.ajax({
                url: "{{ route('admin.orders.bulk-update-status') }}",
                type: 'POST',
                data: {
                    _token: token,
                    item_ids: selectedItems,
                    status: newStatus,
                    update_progress: allSameStatus ? 1 : 0
                },
                success: function (response) {
                    if(response.success) {
                        showStatusMessage(`Status updated to ${newStatus} for selected items`);
                        
                        if (allSameStatus) {
                            location.reload();
                        } else {
                            $('.item-checkbox:checked').each(function() {
                                $(this).closest('tr').find('td:last').text(
                                    newStatus.charAt(0).toUpperCase() + newStatus.slice(1)
                                );
                            });
                        }
                    }
                },
                error: function (xhr) {
                    let errorMsg = 'Something went wrong. Please try again.';
                    if(xhr.status === 422) {
                        errorMsg = xhr.responseJSON.message || errorMsg;
                    }
                    showStatusMessage(errorMsg, 'danger');
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const paymentSelect = document.getElementById('bulk-status-payment');

        paymentSelect.addEventListener('change', function () {
            if (this.value === 'Paid') {
                // Reset to default to avoid accidental form submission
                this.value = "{{ $order->payment_status }}";

                // Show the modal
                const modal = new bootstrap.Modal(document.getElementById('paymentDetailsModal'));
                modal.show();
            }
        });
    });
</script>
@endsection