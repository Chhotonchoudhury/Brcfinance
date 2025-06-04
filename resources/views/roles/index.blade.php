@php
use Spatie\Permission\Models\Permission;
$allPermissions = Permission::all()->pluck('name'); // Fetch all available permissions
@endphp

@extends('layouts.app')

@section('title') Roles & Permissions @endsection

@section('style')
<style>
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-top: 1px solid #dee2e6;
    }

    .footer-info {
        font-size: 0.9rem;
        color: #333;
        background-color: #f0f0f0;
        padding: 0.375rem 0.75rem;
        border-radius: 0.25rem;
        display: flex;
        align-items: center;
        border: 1px solid #d1d1d1;
    }

    .pagination {
        margin-bottom: 0;
    }

    .badge-rounded {
        border-radius: 15px !important;
        padding: 0.3em 0.55em;
        font-size: 0.55rem;
    }

    .btn-sm {
        font-size: 0.75rem;
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection

@section('content')
<div class="row gutters">
    <div class="col-xl-12">
        <div class="card">
            <div class="d-flex justify-content-between align-items-center bg-light w-100 px-2" style="height: 40px;">
                <h6 class="m-0">Roles & Permissions</h6>
                <a href="{{ route('roles.create') }}" onclick="showLoadingEffect(event)"
                    class="btn btn-sm btn-outline-primary">
                    <i class="icon-plus1 me-1"></i> New Role
                    <span id="loadingSpinner" class="spinner-border spinner-border-sm" style="display: none;"
                        role="status"></span>
                </a>
            </div>

            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" action="{{ route('roles.index') }}" class="d-flex align-items-center mb-3">
                    <input type="text" name="search" class="form-control form-control-sm"
                        value="{{ request('search') }}" placeholder="Search roles or permissions..."
                        style="width: 300px; min-height: 30px;">
                    <button type="submit" class="btn btn-outline-primary btn-sm ms-2">
                        <i class="icon-search1 me-1"></i> Search
                    </button>
                </form>

                <!-- Roles Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover m-0">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($roles as $index => $role)
                            <tr>
                                <td>{{ $roles->firstItem() + $index }}</td>
                                <td>
                                    <span class="badge bg-info fs-8">{{ $role->name }}</span>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @foreach ($allPermissions as $perm)
                                        @if ($role->permissions->pluck('name')->contains($perm))
                                        <span class="badge rounded-pill fs-8 px-2 py-1"
                                            style="background-color: #cce5d4; color: #2e7d32;">
                                            {{ $perm }}
                                        </span>
                                        @else
                                        <span class="badge rounded-pill fs-8 px-2 py-1"
                                            style="background-color: #e8eaf6; color: #c05c5c;">
                                            {{ $perm }}
                                        </span>
                                        @endif


                                        @endforeach
                                    </div>
                                </td>
                                <td>
                                    <a href="{{ route('roles.create', $role->id) }}" onclick="showLoadingEffects(event)"
                                        class="btn btn-sm btn-outline-info loading-btn">
                                        <i class="icon-pencil me-1"></i> Edit
                                        <span class="spinner-border spinner-border-sm spinner d-none"
                                            role="status"></span>
                                    </a>

                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="icon-trash me-1"></i> Delete
                                        </button>
                                    </form>

                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">No roles found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
                <div class="footer-info">Total Records: {{ $roles->total() }}</div>
                <div>{{ $roles->links('vendor.pagination.custom-pagination') }}</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    function showLoadingEffects(event) {
        event.preventDefault(); // Prevent immediate navigation

        const button = event.currentTarget;
        const spinner = button.querySelector('.spinner');

        if (spinner) {
            spinner.classList.remove('d-none'); // Show spinner
        }

        // Navigate after short delay or immediately
        window.location.href = button.href;
    }
</script>

@endsection