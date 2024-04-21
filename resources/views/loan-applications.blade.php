<x-layout>
    <div class="modal fade modal-lg" tabindex="-1" id="disburment-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Loan Disbursment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid border">
                        <h5 class="text-center my-3">Loan Details</h5>
                        <div class="row">
                            <div class="col">
                                <label for="principal">Principal Amount</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-currency-rupee"></i></span>
                                    <input type="text" class="form-control" id="principal" readonly>
                                </div>
                            </div>
                            <div class="col">
                                <label for="">Rate of Interest</label>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon2">%</span>
                                    <input type="text" class="form-control" id="interest_rate" readonly>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('status.disburse') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label for="">Loan Duration (in months)</label>
                                    <div class="input-group mb-3" id="">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="bi bi-clock-fill"></i></span>
                                        <input type="text" class="form-control" id="repayment_period"
                                            name="loan_duration" readonly>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">EMI</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="bi bi-calendar2-check"></i></span>
                                        <input type="text" class="form-control" id="monthly_emi" name="emi"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <label for="">Total Amount Payable</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi bi-currency-rupee"></i></span>
                                <input type="text" class="form-control" id="total_payable" name="total_payable"
                                    readonly>
                            </div>
                    </div>

                    <div class="border mt-3 container-fluid">

                        <h5 class="my-3 text-center">Additional Details</h5>
                        <input type="hidden" id="loan-id" name="loan_id">

                        <div class="row">
                            <div class="col">
                                <label for="">EMI Start Date</label>
                                <div class="input-group mb-3" id="">
                                    <span class="input-group-text" id="basic-addon3"><i
                                            class="bi bi-calendar-date"></i></span>
                                    <input type="date" class="form-control" id="emi_start" name="start_date">
                                </div>
                            </div>
                            <div class="col">
                                <label for="">EMI End Date</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1"><i
                                            class="bi bi-calendar-date"></i></span>
                                    <input type="date" class="form-control" id="emi_end" name="end_date">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="disburse" value="disburse" class="btn btn-primary">Disburse Amount</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <x-sidebar>
        <div class="modal modal-lg fade" id="newLoan" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create a New Application</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <form action="/create" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group my-2">
                                <label for="name">Select Employee</label>
                                <select name="employee_id" id="" class="form-select">
                                    <option value="">--Click to select employee-</option>
                                    {{-- @foreach ($empData as $e)
                                        <option value="{{ $e->id }}">{{ $e->name }} -- {{ $e->aadhar_no }}
                                        </option>
                                    @endforeach --}}
                                </select>
                                <x-error prop="name" />
                            </div>
                            <div class="form-group my-2">
                                <label for="loan_amount">Loan Amount</label>
                                <input type="number" class="form-control" id="loan_amount" name="loan_amount"
                                    required>
                            </div>
                            <div class="form-group my-2">
                                <label for="repayment_period">Repayment Period (months)</label>
                                <input type="number" class="form-control" id="repayment_period"
                                    name="repayment_period" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="interest_rate">Interest Rate (%)</label>
                                <input type="number" step="any" class="form-control" id="interest_rate"
                                    name="interest_rate" required>
                            </div>
                            <div class="form-group my-2">
                                <label for="repayment_type">Repayment Type</label><br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="repayment_type"
                                        id="repayment_type_lumpsum" value="lumpsum" required>
                                    <label class="form-check-label" for="repayment_type_lumpsum">Lumpsum</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="repayment_type"
                                        id="repayment_type_emi" value="emi" required>
                                    <label class="form-check-label" for="repayment_type_emi">EMI</label>
                                </div>
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
        <h2>Loan Applications</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow" style=" background-color:#4CCD99;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white"><a href="#">Dashbaord</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Loan Applications</li>
                </ol>
            </nav>
        </div>

        <div class="accordion my-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <h5 class="my-3">Pending Applications</h5>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{-- Pending applications table  --}}
                        <div class="pending-applications">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Loan ID</th>
                                        <th>Name</th>
                                        <th>Loan Amount</th>
                                        <th>Interest Rate</th>
                                        <th>Status</th>
                                        <th>Loan Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($loanApplications as $loan)
                                        @if ($loan->status == 'pending')
                                            <tr>
                                                <td>{{ $loan->id }}</td>
                                                <td>{{ $loan->employee->name }}</td>
                                                <td>{{ $loan->loan_amount }}</td>
                                                <td>{{ $loan->interest_rate }}</td>
                                                <td><span
                                                        class="rounded-pill {{ $loan->status == 'pending' ? 'bg-warning' : 'bg-success' }} fs-6 text-white px-2">{{ $loan->status }}</span>
                                                </td>
                                                <td>{{ ucwords($loan->loan_type) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <form action="{{ route('status.update', $loan->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT') 
                                        
                                                        
                                                            <!-- Button for reject operation -->
                                                            <button type="submit" name="status" value="rejected" class="btn" title="Reject">
                                                                <i class="bi bi-x-circle-fill text-danger fs-5"></i>
                                                            </button>
                                                        
                                                            <!-- Button for accept operation -->
                                                            <button type="submit" name="status" value="accepted" class="btn" title="Accept">
                                                                <i class="bi bi-hand-thumbs-up-fill text-success fs-5"></i>
                                                            </button>
                                                        </form>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>


                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h5 class="my-3">Accepted Applications (Waiting for Disbursment)</h5>

                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{-- Accepted applications table  --}}
                        <div class="accepted-applications">

                            <table class="table table-bordered">
                                <thead>

                                    <tr>
                                        <th>Loan ID</th>
                                        <th>Name</th>
                                        <th>Loan Amount</th>
                                        <th>Interest Rate</th>
                                        <th>Status</th>
                                        <th>Loan Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($loanApplications as $loan)
                                        @if ($loan->status == 'accepted')
                                            <tr>
                                                <td>{{ $loan->id }}</td>
                                                <td>{{ $loan->employee->name }}</td>
                                                <td>{{ $loan->loan_amount }}</td>
                                                <td>{{ $loan->interest_rate }}</td>
                                                <td><span
                                                        class="rounded-pill {{ $loan->status == 'pending' ? 'bg-warning' : 'bg-success' }} fs-6 text-white px-2">{{ $loan->status }}</span>
                                                </td>
                                                <td>{{ ucwords($loan->loan_type) }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                       
                                                        <a href="reject/{{ $loan->id }}" class="btn"
                                                            title="reject"><i
                                                                class="bi bi-x-circle-fill text-danger fs-5"></i></a>
                                                        <a href="" id="disburse" class="btn"
                                                            title="disburse" data-loan-id="{{ $loan->id }}"
                                                            data-loan-period="{{ $loan->repayment_period }}"><i
                                                                class="bi bi-cash-stack fs-5 text-success"></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>


                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h5 class="my-3">Rejected Applications</h5>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        {{-- Rejected applications table  --}}
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Loan ID</th>
                                    <th>Name</th>
                                    <th>Loan Amount</th>
                                    <th>Interest Rate</th>
                                    <th>Status</th>
                                    <th>Loan Type</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($loanApplications as $loan)
                                    @if ($loan->status == 'rejected')
                                        <tr>
                                            <td>{{ $loan->id }}</td>
                                            <td>{{ $loan->employee->name }}</td>
                                            <td>{{ $loan->loan_amount }}</td>
                                            <td>{{ $loan->interest_rate }}</td>
                                            <td><span
                                                    class="rounded-pill bg-danger fs-6 text-white px-2">{{ $loan->status }}</span>
                                            </td>
                                            <td>{{ ucwords($loan->loan_type) }}</td>
                                        </tr>
                                    @endif
                                @endforeach

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>














    </x-sidebar>


</x-layout>
