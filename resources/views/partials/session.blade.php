{{-- @if (session('success'))

    <div class="alert alert-success">
        {{session('success')}}
    </div>

@endif --}}

@if (session('success'))

    <script>
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: "{{ session('success') }}",
            timeout: 3000,
            killer: true
        }).show();
    </script>

@endif