<x-layout>
    <x-sidebar>

        <h1>Loan Details</h1>
        <hr>

        <!-- Basic Details -->
        <h2 class="fst-italic">Basic Details</h2>
        <table class="table">
            <tr>
                <th>Name</th>
                <td>{{ $loan->employee->name }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $loan->employee->phone }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $loan->employee->email }}</td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td>{{ $loan->employee->dob }}</td>
            </tr>
            <tr>
                <th>Aadhar No.</th>
                <td>{{ $loan->employee->aadhar_no }}</td>
            </tr>
            <tr>
                <th>PAN</th>
                <td>{{ $loan->employee->pan_no }}</td>
            </tr>
            <!-- Add other basic details as needed -->
        </table>

        <!-- Basic Loan Details -->
        <h2>Basic Loan Details</h2>
        <table class="table">
            <tr>
                <th>Loan Amount</th>
                <td>{{ $loan->loan_amount }}</td>
            </tr>
            <tr>
                <th>Repayment Period</th>
                <td>{{ $loan->repayment_period }}</td>
            </tr>
            <tr>
                <th>Interest Rate</th>
                <td>{{ $loan->interest_rate }}</td>
            </tr>
            <tr>
                <th>Total Payable</th>
                <td>{{ $loan->total_payable }}</td>
            </tr>
            <tr>
                <th>Loan Start Date</th>
                <td>{{ $loan->start_date }}</td>
            </tr>
            <tr>
                <th>Loan End Date</th>
                <td>{{ $loan->end_date }}</td>
            </tr>
            <tr>
                <th>Disbursed Date</th>
                <td>{{ $loan->end_date }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td><span class="bg-success text-white rounded-3 px-2">Active</span></td>
            </tr>
            <!-- Add other basic loan details as needed -->
        </table>

        <!-- EMI Details -->
        <h2>EMI Details</h2>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        EMI Payment Details
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>EMI Number</th>
                                    <th>EMI Amount</th>
                                    <th>Due Date</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($loan->emis as $emi)
                                    <tr>
                                        <td>{{ $emi->emi_number }}</td>
                                        <td>{{ $emi->emi_amount }}</td>
                                        <td>{{ $emi->due_date }}</td>
                                        <td>{{ $emi->payment_status }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>


        </div>


    </x-sidebar>
</x-layout>
