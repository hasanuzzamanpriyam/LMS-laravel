<div class="col-lg-4">
    <div class="card">
        <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
                <img src="{{ !empty(auth()->user()->photo) ? asset('storage/' . auth()->user()->photo) : url('backend/assets/images/avatars/avatar-2.png') }}"
                    class="rounded-circle p-1 bg-primary" width="110" id="photoPreview">
                <div class="mt-3">
                    <h4>{{ auth()->user()->name }}</h4>
                    <p class="text-secondary mb-1">{{ auth()->user()->email }}</p>
                    <p class="text-muted font-size-sm">{{ auth()->user()->address }}</p>
                    <button class="btn btn-primary">Follow</button>
                    <button class="btn btn-outline-primary">Message</button>
                </div>
            </div>
            <hr class="my-4" />
        </div>
    </div>
</div>
