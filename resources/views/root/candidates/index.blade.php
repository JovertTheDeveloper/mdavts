@extends('root.templates.master')

@section('content')
    @component('root.components.breadcrumbs')
        @slot('page_title')
            List of Candidates
        @endslot

        <li class="breadcrumb-item active">
            Candidates
        </li>

        @slot('action')
            <form method="GET" action="{{ route('root.candidates.create') }}">
                <button type="submit" class="btn btn-info float-right">
                    <i class="fa fa-plus"></i> Create
                </button>
            </form>
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Candidates</h4>
                    <h6 class="card-subtitle">
                        This is the list of candidates in an election.
                    </h6>

                    <div class="table-responsive m-t-40">
                        <div>
                            <table id="table-candidates" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Candidate</th>
                                        <th>Election</th>
                                        <th>Position</th>
                                        <th>Party List</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($candidates as $candidate)
                                        <tr>
                                            <td>
                                                <a href="{{ route('root.users.edit', $candidate->user) }}">
                                                    {{ optional($candidate->user)->full_name_formal }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('root.elections.edit', $candidate->election) }}">
                                                    {{ optional($candidate->election)->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('root.positions.edit', $candidate->position) }}">
                                                    {{ optional($candidate->position)->name }}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('root.partylists.edit', $candidate->party_list) }}">
                                                    {{ optional($candidate->party_list)->name }}
                                                </a>
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
        $('#table-candidates').DataTable({
            "bLengthChange" : false,
        });
    </script>
@endsection
