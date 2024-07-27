@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Roles in Permissions</h4>
                <div>
                </div>
            </div>

            <div class="card-body">
                <form class="form-validate" action="{{ route('roles.permissions.update', ['role' => $role->id]) }}" method="POST"\>
                    @method('PUT')
                    @csrf

                    <div class="mb-3">
                        <h3>{{ $role->name }}</h3>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="checkAllPermission">
                            <label class="form-check-label" for="checkAllPermission">
                                All Permissions
                            </label>
                        </div>
                    </div>

                    @foreach($permission_groups as $group)
                        <div class="row">
                            @php
                                $permissions = \App\Models\Permission::getPermissionByGroupName($group->group_name);
                            @endphp
                            <div class="col-3">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                            {{ \App\Models\Role::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ ucfirst($group->group_name) }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9">
                                @foreach($permissions as $permission)
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permission[]" id="permission{{ $permission->id }}"
                                                {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="permission{{ $permission->id }}">
                                                {{ \Illuminate\Support\Str::title($permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                                <br>
                            </div>
                        </div>
                    @endforeach

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary px-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('#checkAllPermission').click(function () {
        if ($(this).is(':checked')) {
            $('input[type=checkbox]').prop('checked', true);
        } else {
            $('input[type=checkbox]').prop('checked', false);
        }
    });
</script>
@endpush
