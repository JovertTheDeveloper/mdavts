@extends('root.templates.master')

@section('content')
    @component('root.components.breadcrumbs')
        @slot('page_title')
            Edit profile
        @endslot

        <li class="breadcrumb-item active">
            Profile
        </li>
    @endcomponent

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Please fill up the form</h4>
                    <h6 class="card-subtitle"></h6>

                    <form method="POST" action="{{ route('root.account.profile.update') }}" class="form-material m-t-40">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <div class="row">
                                <!-- Firstname -->
                                <div class="col-md">
                                    <label for="firstname">First Name</label>

                                    <input
                                        type="text"
                                        name="firstname"
                                        id="firstname"
                                        class="form-control form-control-line"
                                        value="{{ $admin->firstname }}"
                                        placeholder="Enter First Name"
                                    >

                                    @if ($errors->has('firstname'))
                                        <span class="text-danger">
                                            {{ $errors->first('firstname') }}
                                        </span>
                                    @endif
                                </div>
                                <!--/. Firstname -->

                                <!-- Middlename -->
                                <div class="col-md">
                                    <label for="middlename">Middle Name</label>

                                    <input
                                        type="text"
                                        name="middlename"
                                        id="middlename"
                                        class="form-control form-control-line"
                                        value="{{ $admin->middlename }}"
                                        placeholder="Enter Middle Name"
                                    >

                                    @if ($errors->has('middlename'))
                                        <span class="text-danger">
                                            {{ $errors->first('middlename') }}
                                        </span>
                                    @endif
                                </div>
                                <!--/. Middlename -->

                                <!-- Lastname -->
                                <div class="col-md">
                                    <label for="lastname">Last Name</label>

                                    <input
                                        type="text"
                                        name="lastname"
                                        id="lastname"
                                        class="form-control form-control-line"
                                        value="{{ $admin->lastname }}"
                                        placeholder="Enter Last Name"
                                    >

                                    @if ($errors->has('lastname'))
                                        <span class="text-danger">
                                            {{ $errors->first('lastname') }}
                                        </span>
                                    @endif
                                </div>
                                <!--/. Lastname -->
                            </div>
                        </div>

                        <!-- Birthdate -->
                        <div class="form-group">
                            <label for="birthdate">Birth Date</label>

                            <input
                                type="text"
                                name="birthdate"
                                id="birthdate"
                                class="form-control form-control-line"
                                value="{{ $admin->birthdate }}"
                                placeholder="Enter Birth Date"
                            >

                            @if ($errors->has('birthdate'))
                                <span class="text-danger">
                                    {{ $errors->first('birthdate') }}
                                </span>
                            @endif
                        </div>
                        <!--/. Birthdate -->

                        <!-- Gender -->
                        <div class="form-group">
                            <label for="gender">Gender</label>

                            <select name="gender" id="gender" class="form-control">
                                <option selected disabled>Please select a gender</option>
                                <option value="male" {{ $admin->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $admin->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>

                            @if ($errors->has('gender'))
                                <span class="text-danger">
                                    {{ $errors->first('gender') }}
                                </span>
                            @endif
                        </div>
                        <!--/. Gender -->

                        <!-- Address -->
                        <div class="form-group">
                            <label for="address">Address</label>

                            <input
                                type="text"
                                name="address"
                                id="address"
                                class="form-control form-control-line"
                                value="{{ $admin->address }}"
                                placeholder="Enter Address"
                            >

                            @if ($errors->has('address'))
                                <span class="text-danger">
                                    {{ $errors->first('address') }}
                                </span>
                            @endif
                        </div>
                        <!--/. Address -->

                        <!-- Email -->
                        <div class="form-group">
                            <label for="email">Email</label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control form-control-line"
                                value="{{ $admin->email }}"
                                placeholder="Enter Email"
                            >

                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    {{ $errors->first('email') }}
                                </span>
                            @endif
                        </div>
                        <!--/. Email -->

                        <!-- Contact number -->
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>

                            <input
                                type="number"
                                name="contact_number"
                                id="contact_number"
                                class="form-control form-control-line"
                                value="{{ $admin->contact_number }}"
                                placeholder="Enter Contact Number"
                            >

                            @if ($errors->has('contact_number'))
                                <span class="text-danger">
                                    {{ $errors->first('contact_number') }}
                                </span>
                            @endif
                        </div>
                        <!--/. Contact number -->

                        <!-- Submit -->
                        <div class="form-group">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-edit"></i> Update
                            </button>

                            <a href="{{ route('root.admins.index') }}" class="btn btn-secondary">
                                Cancel
                            </a>
                        </div>
                        <!--/. Submit -->
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="/assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>

    <script>
        $('#birthdate').bootstrapMaterialDatePicker({time: false});
    </script>
@endsection