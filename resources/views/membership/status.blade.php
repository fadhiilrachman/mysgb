<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Membership Status</h3>
                <p class="text-subtitle text-muted">MySGB account priviledge.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('membership.status') }}">Membership</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Status</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Status</h4>
            </div>
            <div class="card-body">
                Current status:
                {{-- <span class="badge bg-light-primary">Level 1</span> --}}
                <span class="badge bg-light-secondary">Not a SGB TEAM Member</span>
                <span class="badge bg-light-success">Verified Email</span>
            </div>
        </div>
    </section>
</x-app-layout>
