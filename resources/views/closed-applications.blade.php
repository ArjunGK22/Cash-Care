<x-layout>
    <x-sidebar>
        
        <h2>Closed Loans</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow" style=" background-color:#4CCD99;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white"><a href="#">Dashbaord</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Closed Loans</li>
                </ol>
            </nav>
        </div>

        <div class="closed">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>PAN No</th>
                        <th>Loan ID</th>
                        <th>Total Principal Paid </th>
                        <th>Loan Status</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($loans as $loan)
                            <tr>
                                <td>{{ $loan->employee->name }}</td>
                                <td>{{ $loan->employee->pan_no }}</td>
                                <td>{{ $loan->id }}</td>
                                <td>{{ $loan->total_payable }}</td>
                                <td>{{ $loan->status }}</td>
                                <td>{{ $loan->start_date}}</td> 
                                <td>{{ $loan->end_date}}</td>
                                <td><a href="/loans/{{ $loan->id }}" class="btn" title="view"><i class="bi bi-eye-fill"></i></a></td>
                               
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-sidebar>


</x-layout>
