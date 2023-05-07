<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>
                    Sharing 
                    <a href="{{ route('sharing.create-new') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create New</a>
                    <a href="{{ route('sharing.my-list') }}" class="btn btn-outline-primary"><i class="bi bi-card-text"></i> My List</a>
                </h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('sharing.list') }}">Sharing</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">List</h4>
            </div>
            <div class="card-body">
                <form class="list form" action="{{ route('sharing.list') }}" method="get">
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
                                        <th>Title</th>
                                        <th>Author</th>
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
