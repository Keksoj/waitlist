@if (session('success'))
    <x-alert type="success" :message="session('success')" />
@endif
