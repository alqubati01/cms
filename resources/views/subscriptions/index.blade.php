@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Subscriptions</h4>
                <div>
{{--                    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTagModal">Add Tag</a>--}}
                    <div id="headingOne"
                         data-bs-toggle="collapse"
                         data-bs-target="#collapseOne"
                         aria-controls="collapseOne"
                         aria-expanded="true"
                         role="button"
                         class="btn btn-primary">
                        <span>Filters</span>
                    </div>
                </div>
            </div>

            <form action="{{ route('subscriptions.index') }}" method="GET">
                <div id="collapseOne"
                     class="collapse hidden px-4 pt-3 pb-2"
                     aria-labelledby="headingOne"
                     data-bs-parent="#accordion-one">
                    <div class="form-row">
                        <div class="col-4">
                            <input class="form-control mb-2" type="text" name="search_text" placeholder="Search by tag name">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-20">Filter</button>
                    <a href="{{route('subscriptions.index')}}" class="btn btn-primary w-20">Clear Filter</a>
                </div>
            </form>
            <hr class="m-0"/>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                            <tr>
                                <th class="width50">
                                    <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                        <input type="checkbox" class="form-check-input mt-0" id="checkAll" required="">
                                        <label class="custom-control-label" for="checkAll"></label>
                                    </div>
                                </th>
                                <th><strong>Name</strong></th>
                                <th><strong>Email</strong></th>
                                <th><strong>Plan</strong></th>
                                <th><strong>Active Until</strong></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tags">
                            @forelse($subscriptions as $subscription)
                                <tr>
                                    <td>
                                        <div class="custom-control custom-checkbox checkbox-success check-lg me-3">
                                            <input type="checkbox" class="form-check-input mt-0" id="customCheckBox2" required="">
                                            <label class="custom-control-label" for="customCheckBox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('users.show', ['user' => $subscription->user->id]) }}" class="fw-semibold">
                                            {{ $subscription->user->name }}
                                        </a>
                                    </td>
                                    <td>{{ $subscription->user->email }}</td>
                                    <td>{{ \Illuminate\Support\Str::ucfirst($subscription->plan->slug) }}</td>
                                    <td>{{ $subscription->active_until }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-outline-light sharp" data-bs-toggle="dropdown">
                                                <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                            </button>
                                            <div class="dropdown-menu">
{{--                                                <a class="dropdown-item"></a>--}}
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        No Subscriptions Founded Yet!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{ $subscriptions->appends($data)->links() }}
@endsection

