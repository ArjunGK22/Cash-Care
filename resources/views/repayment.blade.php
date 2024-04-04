<x-layout>
    <!-- Modal -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="reschedule" method="POST">
                    @csrf
                    <div class="modal-body">
                        <p class="text-danger">You are freezing the EMI. Kindly select the restart date when it has to
                            be paid.</p>
                        <div class="input-group">
                            <input type="text" id="emi_id" name="emiId">
                            <input type="date" name="restart_date" class="form-control" min="{{ date('Y-m-d') }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="reschedule" class="btn btn-primary">Pause EMI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <x-sidebar>

        <h1>Loan Repayment</h1>
        <hr>
        <div class="container mt-5">
            <h2 class="text-center mb-4">User and Loan Information</h2>
            <div class="row">
                <!-- User Details Section -->
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            User Details
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Name:</strong> {{ $user->loan->employee->name }}</li>
                                <li class="list-group-item"><strong>Phone:</strong> {{ $user->loan->employee->phone }}</li>
                                <li class="list-group-item"><strong>Email:</strong> {{ $user->loan->employee->email }}</li>
                                <li class="list-group-item"><strong>Date of Birth:</strong> {{ $user->loan->employee->dob }}</li>
                                <li class="list-group-item"><strong>Aadhar Number:</strong> {{ $user->loan->employee->aadhar_no }}</li>
                                <li class="list-group-item"><strong>PAN Number:</strong> {{ $user->loan->employee->pan_no }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Loan Information Section -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            Loan Information
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Loan Amount:</strong>
                                    {{ $user->loan->loan_amount }}</li>
                                <li class="list-group-item"><strong>Repayment Period:</strong>
                                    {{ $user->loan->repayment_period }}</li>
                                <li class="list-group-item"><strong>Interest Rate:</strong>
                                    {{ $user->loan->interest_rate }}</li>
                                <li class="list-group-item"><strong>Total Payable:</strong>
                                    {{ $user->loan->total_payable }}</li>
                                <li class="list-group-item"><strong>EMI:</strong> {{ $user->loan->emi }}</li>
                                <li class="list-group-item"><strong>Payment Status:</strong>
                                    {{ $user->current_status }}</li>
                                <li class="list-group-item"><strong>EMI Remaining:</strong>
                                    {{ $user->remaining_emi }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Payment Information Section -->
                <form action="/loans/repayment" method="POST">
                    @csrf
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-secondary text-white">
                                    Payment Information
                                </div>
                                <div class="card-body">
                                    <!-- Populate input values here -->
                                    <!-- For example, payment date -->
                                    <table class="table table-bordered table-responsive">
                                        <tr>
                                            <th>EMI Due Date</th>
                                            <th>EMI (to pay)</th>
                                            <th>EMI (paying)</th>
                                            <th>Principal Amount</th>
                                            <th>Interest Amount</th>
                                            <th>Fine</th>
                                        </tr>

                                        <tr>
                                            <td><input class="form-control" type="date"
                                                    value="{{ $user->due_date }}" readonly>
                                            </td>
                                            <td><input class="form-control" type="text"
                                                    value="{{ $user->remaining_emi_balance }}"
                                                    name="emi_payable" id="emi" readonly></td>
                                            <td><input class="form-control" type="text"
                                                    value="{{ $user->remaining_emi_balance }}"
                                                    name="emi_paid" onkeyup="validateEmiAmount(this);" />
                                                <span class="text-danger" id="emiValidate"></span>
                                            </td>
                                            </td>
                                            <td><input class="form-control" type="text"
                                                    value="{{ $user->principal_amount }}" readonly>
                                            </td>
                                            <td><input class="form-control" type="text"
                                                    value="{{ $user->interest_amount }}" readonly>
                                            </td>

                                            <td><input class="form-control" type="text"
                                                    value="{{ $user->fine_amount }}"
                                                    name="fine_amount" readonly></td>

                                        </tr>
                                    </table>
                                </div>
                                <div class="card-footer">
                                    <!-- Populate hidden input values if needed -->
                                    <!-- For example, repayment id -->
                                    <input type="test" value="{{ $user->id }}" name="emi_id" />
                                    <input type="test" value="{{ $user->loan_id }}"
                                        name="loan_id" />
                                    <!-- Populate other hidden input values similarly -->
                                    <button class="btn btn-primary mr-2" id="reschedule" type="button"
                                        data-emiId ="{{ $user->id }}">Reschedule</button>
                                    <button class="btn btn-success mr-2" type="submit" name="action"
                                        value="Repay" id="repay">Repay</button>
                                    <button class="btn btn-danger">Other</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-sidebar>
</x-layout>
