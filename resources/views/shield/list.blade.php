<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>
                    Shield
                    <a href="{{ route('shield.build-new') }}" class="btn btn-primary"><i class="bi bi-hammer"></i> Build New</a>
                </h3>
                <p class="text-subtitle text-muted">Secure your BOT things.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('shield.list') }}">Shield</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">My List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">My List</h4>
            </div>
            <div class="card-body">
                <form class="list form" action="{{ route('shield.list') }}" method="get">
                    <input type="hidden" name="start_date">
                    <input type="hidden" name="end_date">
                    <div class="row">
                        <div class=" col-md-4 col-sm-12 col-xs-12">
                            <div class="form-group position-relative has-icon-left">
                                <input type="text" id="date" name="date" class="form-control" placeholder="Start date - End date">
                                <div class="form-control-icon">
                                    <i class="bi bi-calendar"></i>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group position-relative has-icon-right">
                                <input type="text" id="q" name="q" class="form-control" placeholder="Search title..">
                                <div class="form-control-icon">
                                    <i class="fa fa-times btn-clear-search"></i>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-2 col-sm-12 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block" id="search-btn">Search</button>
                            <br>
                            <br>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table-list table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Client Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
