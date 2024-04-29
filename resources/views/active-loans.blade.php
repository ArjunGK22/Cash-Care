<x-layout>
    <x-sidebar>
        <div class="modal modal-lg fade" id="newLoan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create a New Application</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('loans.store') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group my-2">
                                <label for="name">Select Employee</label>
                                <select name="employee_id" id="" class="form-select">
                                    <option value="">--Click to select employee-</option>
                                    @foreach ($empData as $e)
                                        <option value="{{ $e->id }}">{{ $e->name }} -- {{ $e->aadhar_no }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-error prop="employee_id" />
                            </div>
                            <div class="form-group my-2">
                                <label for="loan_amount">Loan Amount</label>
                                <input type="number" class="form-control" id="loan_amount" name="loan_amount" >
                                <x-error prop="loan_amount" />

                            </div>
                            <div class="form-group my-2">
                                <label for="repayment_period">Repayment Period (months)</label>
                                <input type="number" class="form-control" id="repayment_period" name="repayment_period"
                                    >
                                <x-error prop="repayment_period" />

                            </div>
                            <div class="form-group my-2">
                                <label for="interest_rate">Interest Rate (%)</label>
                                <input type="number" step="any" class="form-control" id="interest_rate"
                                    name="interest_rate" >
                                <x-error prop="interest_rate" />

                            </div>
                            <div class="form-group my-2">
                                <label for="repayment_type">Repayment Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="loan_type"
                                        id="repayment_type_lumpsum" value="lumpsum" required>
                                    <label class="form-check-label" for="repayment_type_lumpsum">Lumpsum</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="loan_type"
                                        id="repayment_type_emi" value="emi" required>
                                    <label class="form-check-label" for="repayment_type_emi">EMI</label>
                                </div>
                                <x-error prop="loan_type" />

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Application </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h2>Active Loans</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow" style=" background-color:#4CCD99;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white"><a href="#">Dashbaord</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Active Loans</li>
                </ol>
            </nav>
        </div>

        {{-- create Application button  --}}
        <div class="d-flex justify-content-between my-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newLoan">
                Create New Application
            </button>
            <select name="employee_id" id="filterDropdown" class="form-select w-25">
                <option value="0" {{ $employeeId == 0 ? 'selected' : '' }}>All</option>
                @foreach ($empData as $e)
                    <option value="{{ $e->id }}" {{ $employeeId == $e->id ? 'selected' : '' }}>
                        {{ $e->name }} -- {{ $e->pan_no }}</option>
                @endforeach
            </select>

        </div>

        <div class="repayments">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>PAN No</th>
                        <th>Loan ID</th>
                        <th>Total Payable (Principal)</th>
                        <th>Loan Status</th>
                        <th>Loan Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($loanData as $loan)
                        <tr>
                            <td>{{ $loan->employee->name }}</td>
                            <td>{{ $loan->employee->pan_no }}</td>
                            <td>{{ $loan->id }}</td>
                            <td>{{ $loan->total_payable }}</td>
                            <td>{{ $loan->status }}</td>
                            <td>{{ $loan->loan_type }}</td> <!-- Accessing emi directly from $repays -->
                            {{-- <td>{{ $loan->due_date }}</td> --}}
                            {{-- <td>
                                    @if (date('Y-m-d') < $loan->start_date)
                                        <span class="rounded-pill bg-warning fs-6 text-white px-2">Unpaid
                                        </span>
                                    @else
                                        <span class="rounded-pill bg-danger fs-6 text-white px-2">Overdue
                                        </span>
                                    @endif


                                </td> --}}
                            <td>
                                <div class="d-flex">
                                    <a href="/loans/{{ $loan->id }}" class="btn" title="view"><i
                                            class="bi bi-eye-fill"></i></a>
                                    {{-- <form action="{{ route('status.update', $loan->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')


                                        <!-- Button for reject operation -->
                                        <button type="submit" name="status" value="cancel" class="btn"
                                            title="Cancel">
                                            <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                        </button>

                                    </form> --}}

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-sidebar>


</x-layout>
