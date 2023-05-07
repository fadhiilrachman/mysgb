<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('sharing.list') }}">Sharing</a>
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
                <h4 class="card-title"><span class="badge bg-primary">{{ Str::upper($data->view_mode) }}</span> {{ $data->title }}</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-3">
                                <div class="list-group" role="tablist">
                                    <a class="list-group-item list-group-item-action active" id="description-list" data-bs-toggle="list" href="#description" role="tab">Description</a>
                                    <a class="list-group-item list-group-item-action" id="information-list" data-bs-toggle="list" href="#information" role="tab">Information</a>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-9 mt-1">
                                <div class="tab-content text-justify" id="nav-tabContent">
                                <div
                                    class="tab-pane show active"
                                    id="description"
                                    role="tabpanel"
                                    aria-labelledby="description-list"
                                >
                                    {{ $data->description }}
                                </div>
                                <div
                                    class="tab-pane"
                                    id="information"
                                    role="tabpanel"
                                    aria-labelledby="information-list"
                                >
                                    Total Viewers : <span class="badge bg-primary">{{ $data->total_views }}</span><br>
                                    @foreach (json_decode($data->labels) as $item)
                                        <span class="badge bg-secondary">#{{ $item }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <p>
                            {!! $data->body !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
