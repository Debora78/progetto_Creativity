<x-layout>
    <section class="container-fluid p-5 bg-secondary-subtle text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="display-1">Welcome to Creativity</h1>
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                @endif
            </div>
        </div>
    </section>

</x-layout>
