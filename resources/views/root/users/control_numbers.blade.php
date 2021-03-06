@extends('root.templates.master')

@section('content')
    @component('root.components.breadcrumbs')
        @slot('page_title')
            List of Control Numbers
        @endslot

        <li class="breadcrumb-item">
            <a href="{{ route('root.users.index') }}">Users</a>
        </li>

        <li class="breadcrumb-item">
            <a href="{{ route('root.users.edit', $user) }}">
                {{ $user->full_name }}
            </a>
        </li>

        <li class="breadcrumb-item active">
            Control Numbers
        </li>
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">
                        Control Numbers
                    </h4>

                    <h6 class="card-subtitle">
                        This is {{ $user->full_name }}'s Control Numbers
                    </h6>

                    <div class="table-responsive m-t-40">
                        <div>
                            <table id="table-control-numbers" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Election</th>
                                        <th>Number</th>
                                        <th>Used</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($control_numbers as $cn)
                                        <tr>
                                            <td>
                                                <a href="{{ route('root.elections.edit', $cn->election) }}">
                                                    {{ $cn->election->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">
                                                    {{ $cn->number }}
                                                </span>
                                            </td>
                                            <td>
                                                @unless ($cn->used)
                                                    <span class="label label-rounded label-danger">
                                                        No
                                                    </span>
                                                @else
                                                    <span class="label label-rounded label-success">
                                                        Yes
                                                    </span>
                                                @endunless
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="/assets/plugins/datatables/datatables.min.js"></script>

    <script>
        $('#table-control-numbers').DataTable({
            "bLengthChange" : false,
        });
    </script>
@endsection