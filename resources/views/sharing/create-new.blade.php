<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Create a new Share</h3>
                <p class="text-subtitle text-muted">Share what you know.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('sharing.list') }}">Sharing</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create New</li>
                    </ol>
                </nav>
            </div>
        </div>
    </x-slot>
    
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New</h4>
            </div>
            <div class="card-body">
                @if(session()->get('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if(session()->get('errors'))
                    <div class="alert alert-danger">
                        {{ session()->get('errors')->first() }}
                    </div>
                @endif
                <form class="form" action="{{ route('sharing.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" value="{{ old('title') }}" autofocus id="title" name="title" class="form-control" placeholder="Put title here.." />
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" placeholder="Put description here.." rows="4">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="view_mode">View Mode</label>
                                <select class="form-select" id="view_mode" name="view_mode">
                                    <option value="public" {{ old('view_mode')=='public'?'selected':'' }}>Public (all user can view)</option>
                                    <option value="private" {{ old('view_mode')=='private'?'selected':'' }}>Private (only member can view)</option>
                                    <option value="secret" {{ old('view_mode')=='secret'?'selected':'' }}>Secret (only with a secret code can view)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="listing_mode">Listing Mode</label>
                                <select class="form-select" id="listing_mode" name="listing_mode">
                                    <option value="yes" {{ old('listing_mode')=='yes'?'selected':'' }}>Show (all user can search)</option>
                                    <option value="no" {{ old('listing_mode')=='no'?'selected':'' }}>Don't Show (only with link)</option>
                                </select>
                            </div>
                            <div class="form-group" style="display: {{ old('view_mode')=='secret'?'block':'none' }};" id="input-secret-code">
                                <label for="secret_code">Secret Code</label>
                                <input type="text" value="{{ old('secret_code') }}" id="secret_code" name="secret_code" class="form-control" placeholder="Put secret code here.." />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dom_body">Body</label>
                                <textarea name="body" id="dom_body" cols="30" rows="10">{{ old('body') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="labels">Labels</label>
                                <select class="choices form-select multiple-remove" id="labels" name="labels[]" multiple="multiple">
                                <optgroup label="Hastags">
                                    <option value="sgbsell">#sgbsell</option>
                                    <option value="sgbask">#sgbask</option>
                                    <option value="sgbshare">#sgbshare</option>
                                    <option value="sgbbuy">#sgbbuy</option>
                                    <option value="sgbinfo">#sgbinfo</option>
                                    <option value="sgbhelp">#sgbhelp</option>
                                    <option value="sgbneed">#sgbneed</option>
                                    <option value="sgboot">#sgboot</option>
                                    <option value="sgbmabar">#sgbmabar</option>
                                </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="expired_date">Expired At (optional)</label>
                                <input type="date" value="{{ old('expired_at') }}" id="expired_date" name="expired_date" class="form-control flatpickr-no-config" placeholder="Put expired date here.." />
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