<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>
                    Shield
                </h3>
                <p class="text-subtitle text-muted">Secure your BOT things.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('shield.list') }}">Shield</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $data->client_name }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        @if(session()->get('errors'))
                            <div class="alert alert-danger">
                                {{ session()->get('errors')->first() }}
                            </div>
                        @endif
                        @if(session()->get('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3">
                                <div class="list-group" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="information-list" data-bs-toggle="list" href="#information" role="tab">
                                        Information
                                    </a>
                                    <a class="list-group-item list-group-item-action" id="connectedDevices-list" data-bs-toggle="list" href="#connectedDevices" role="tab">
                                        Connected Devices
                                    </a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9 mt-1">
                                <div class="tab-content text-justify" id="nav-tabContent">
                                <div
                                    class="tab-pane show active"
                                    id="information"
                                    role="tabpanel"
                                    aria-labelledby="information-list"
                                >
                                    Guard Mode : <span class="badge bg-primary">{{ Str::upper($data->guard_mode) }}</span><br>
                                    Max. devices : {{ $data->max_devices }}<br>
                                    Total connected devices : <span class="badge bg-primary">{{ "0" }}</span><br>
                                    Expired time : {{ $data->expired_at }}
                                </div>
                                <div
                                    class="tab-pane"
                                    id="connectedDevices"
                                    role="tabpanel"
                                    aria-labelledby="connectedDevices-list"
                                >
                                    {{-- Devices here --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
