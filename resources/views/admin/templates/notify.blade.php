@if (session('notify_action'))
            <div class="alert alert-success">
                {{ session('notify_action') }}
            </div>
        @endif