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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Inboxes</a></li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
                <h4 class="page-title">Messages</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-7">
                        </div><!-- end col-->
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-centered mb-0 w-100 dt-responsive nowrap" id="inbox-datatable">
                            <thead class="table-dark">
                                <tr>
                                    <th>From</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inboxes as $message)
                                    <tr class="view-message"
                                        data-id="{{ $message->id }}"
                                        data-message="{{ $message->message }}"
                                        data-subject="{{ $message->subject }}"
                                        data-phone="{{ $message->phone }}"
                                        data-email="{{ $message->email }}">
                                        
                                        <td>
                                        <strong>{{ $message->name }}</strong>
                                            @if(!$message->is_read)
                                                <span class="badge bg-primary new-badge ms-2" id="badge-{{ $message->id }}">New</span>
                                            @endif
                                        </td>
                                        <td class="message-cell">
                                            {!! \Illuminate\Support\Str::limit('<strong>' . e($message->subject) . '</strong>&nbsp&nbsp' . strip_tags($message->message), 100, '...') !!}
                                        </td>
                                        <td>{{ $message->created_at ? $message->created_at->format('F d Y') : '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- View Message Modal -->
    <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewMessageModalLabel">Message</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p><strong>Subject:</strong> <span id="modal-subject"></span></p>
                <p><strong>From:</strong> <span id="modal-email"></span></p>
                <p><strong>Phone:</strong> <span id="modal-phone"></span></p>
                <p><strong>Message:</strong></p>
                <p id="modal-message" class="border p-2 bg-light"></p>
            </div>
            </div>
        </div>
    </div>

    <!-- end row -->
    <script>
    document.querySelectorAll('.view-message').forEach(row => {
        row.addEventListener('click', function () {
            const message = this.getAttribute('data-message');
            const subject = this.getAttribute('data-subject');
            const phone = this.getAttribute('data-phone');
            const email = this.getAttribute('data-email');
            const id = this.getAttribute('data-id');
            const markAsReadUrlTemplate = "{{ route('admin.inbox.markAsRead', ':id') }}";

            document.getElementById('modal-message').textContent = message;
            document.getElementById('modal-subject').textContent = subject;
            document.getElementById('modal-phone').textContent = phone;
            document.getElementById('modal-email').textContent = email;

            const modal = new bootstrap.Modal(document.getElementById('viewMessageModal'));
            modal.show();

            const url = markAsReadUrlTemplate.replace(':id', id);
            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const badge = document.getElementById(`badge-${id}`);
                    if (badge) {
                        badge.remove();
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
<style>
    .message-cell {
        max-width: 250px; /* Adjust based on your layout */
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    tr.view-message {
        cursor: pointer;
    }

    tr.view-message:hover {
        background-color: #f1f1f1;
    }
</style>
@endsection