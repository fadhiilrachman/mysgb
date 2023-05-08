<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Build a new Shield</h3>
                <p class="text-subtitle text-muted">Set up your client shield.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('shield.list') }}">Shield</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Build New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Build New</h4>
            </div>
            <div class="card-body">
                @if(session()->get('errors'))
                    <div class="alert alert-danger">
                        {{ session()->get('errors')->first() }}
                    </div>
                @endif
                <form class="form" action="{{ route('shield.build-new') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_name">Client Name</label>
                                <input type="text" value="{{ old('client_name') }}" autofocus id="client_name" name="client_name" class="form-control" placeholder="Put client name here.." />
                            </div>
                            <div class="form-group">
                                <label for="max_devices">Max. Connected Devices</label>
                                <input type="number" value="{{ old('max_devices') }}" autofocus id="max_devices" name="max_devices" class="form-control" min="1" max="100" placeholder="Put max devices here.." />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="guard_mode">Guard Mode</label>
                                <select class="form-select" id="guard_mode" name="guard_mode">
                                    <option value="public" {{ old('guard_mode')=='public'?'selected':'' }}>Public (all user can connect)</option>
                                    <option value="private" {{ old('guard_mode')=='private'?'selected':'' }}>Private (only member can connect)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expired_time">Expired Shield Time</label>
                                <select class="form-select" id="expired_time" name="expired_time">
                                    <option value="1d" {{ old('expired_time')=='1d'?'selected':'' }}>1 day</option>
                                    <option value="3d" {{ old('expired_time')=='3d'?'selected':'' }}>3 days</option>
                                    <option value="5d" {{ old('expired_time')=='5d'?'selected':'' }}>5 days</option>
                                    <option value="1w" {{ old('expired_time')=='1w'?'selected':'' }}>1 week</option>
                                    <option value="1m" {{ old('expired_time')=='1m'?'selected':'' }}>1 month</option>
                                    <option value="never" {{ old('expired_time')=='never'?'selected':'' }}>Never expire</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-end">
                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                            <button type="submit" class="btn btn-primary me-1 mb-1"><i class="bi bi-send"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>