<x-layout>
    <x-sidebar>
        <h2>Loan Repayments</h2>

        {{-- bread cumbs  --}}
        <div class="card p-3 shadow" style=" background-color:#4CCD99;">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-white"><a href="#">Dashbaord</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">Loan Repayment</li>
                </ol>
            </nav>
        </div>

        <x-message />


        <div class="repayments">
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>EMI ID</th>
                        <th>Loan ID</th>
                        <th>EMI Amount</th>
                        <th>Remaining EMI Balance</th>
                        <th>Payment Status</th>
                        <th>Due Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($emiData as $emi)
                            <tr>
                                <td>{{ $emi->id }}</td>
                                <td>{{ $emi->loan->id }}</td>
                                <td>{{ $emi->emi_amount }}</td>
                                <td>{{ $emi->remaining_emi_balance }}</td>
                                <td>{{ $emi->payment_status }}</td>
                                <td>{{ $emi->due_date }}</td>
                           
                                <td>
                                    <div class="d-flex">
                                        <a href="repayment/{{ $emi->id }}" class="btn" title="payment"><i
                                                class="bi bi-credit-card text-success"></i></a>

                                    </div>
                                </td>
                            </tr>
                    @endforeach
                </tbody>


            </table>

        </div>



    </x-sidebar>


</x-layout>
