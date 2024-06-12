<x-filament::page>
    <div class="container mt3">
        <div class="d-flex justify-content-end mb-8">
            <a href="{{ 'http://localhost/admin/login' }}" class="btn btn-primary d-flex align-items-center">
                <x-heroicon-o-arrow-right-on-rectangle class="w-10"/>
            </a>
        </div>

        <div class="card">
            <div class="card-body">
                {{ $this->table }}
            </div>
        </div>
    </div>
</x-filament::page>
