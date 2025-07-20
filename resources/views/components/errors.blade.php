@if ($errors->any())
    <x-alert type="error">
        <ul class="list-dic pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif
