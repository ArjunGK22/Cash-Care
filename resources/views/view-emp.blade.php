<x-layout>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="/create/employee" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group my-2">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="fname" placeholder="Enter your name"
                                name="name">
                            <x-error prop="name" />
                        </div>
                        <div class="form-group my-2">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email"
                                name="email">
                            <x-error prop="email" />

                        </div>
                        <div class="form-group my-2">
                            <label for="phone">Phone</label>
                            <input type="tel" class="form-control" id="phone"
                                placeholder="Enter your phone number" name="phone">
                            <x-error prop="phone" />

                        </div>
                        <div class="form-group my-2">
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob">
                            <x-error prop="dob" />

                        </div>
                        <div class="form-group my-2">
                            <label for="aadhar">Aadhar Number</label>
                            <input type="text" class="form-control" id="aadhar"
                                placeholder="Enter your Aadhar number" name="aadhar_no">
                            <x-error prop="aadhar_no" />

                        </div>
                        <div class="form-group my-2">
                            <label for="pan">PAN Number</label>
                            <input type="text" class="form-control" id="pan"
                                placeholder="Enter your PAN number" name="pan_no">
                            <x-error prop="pan_no" />

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <x-sidebar>

        <h2>View Users</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow" style=" background-color:#4CCD99;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white"><a href="#">Dashbaord</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Users</li>
                </ol>
            </nav>
        </div>

        <div class="container-fluid p-0 mt-3">
            {{-- create button  --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create User
            </button>

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Aadhar</th>
                        <th>PAN</th>
                        <th>DOB</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($userdata as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->aadhar_no }}</td>
                            <td>{{ $user->pan_no }}</td>
                            {{-- <td>{{$user->dob}}</td> --}}
                            <td><span class="rounded-pill bg-success fs-6 text-white px-2">Active</span></td>
                            <td></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>


    </x-sidebar>

</x-layout>
