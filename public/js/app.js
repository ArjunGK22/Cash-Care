function validateEmiAmount(e){

    $emi = parseFloat(document.getElementById('emi').value);
    $payable = parseFloat(e.value);

    console.log($emi);
    console.log($payable);

    if($payable > $emi){
        // console.log('in side');
        document.getElementById('emiValidate').innerHTML = "Amount more than EMI";
        document.getElementById('repay').disabled = true;
    }
    else{
        document.getElementById('emiValidate').innerHTML = "";
        document.getElementById('repay').disabled = false;

    }

}



$(document).ready(function () {

    $('.table tbody').on('click', '#disburse', function (e) {
        e.preventDefault();


        //get row data
        var rowData = $(this).closest('tr').find('td').map(function () {
            return $(this).text();
        }).get();

        //assigning the values to variable
        var principal = parseFloat(rowData[2]);
        var annualInterestRate = parseFloat(rowData[3]);
        var loanDurationInMonths = parseInt($(this).data('loan-period'));
        var monthlyInterestRate = annualInterestRate / 12 / 100;

        //population data to the tags
        $('#loan-id').val(rowData[0]);
        $('#principal').val(rowData[2]);
        $('#interest_rate').val(rowData[3]);
        $('#repayment_period').val(loanDurationInMonths);

        //EMI Calculation
        var emi = principal * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, loanDurationInMonths) / (Math.pow(1 + monthlyInterestRate, loanDurationInMonths) - 1);

        //population data to the tags
        $('#monthly_emi').val(emi.toFixed(2));
        $('#total_payable').val(emi.toFixed(2) * loanDurationInMonths);


        var currentDate = new Date();

        // Add one month to the current date
        var emiStartDate = new Date(currentDate); // Create a copy for emi_start
        emiStartDate.setMonth(emiStartDate.getMonth() + 1);
        emiStartDate.setDate(5);

        // Format the emi_start date as required (YYYY-MM-DD for input type=date)
        var nextMonthStartDate = emiStartDate.toISOString().slice(0, 10);
        $('#emi_start').val(nextMonthStartDate);

        // Move currentDate to the end of the loan duration
        currentDate.setMonth(currentDate.getMonth() + loanDurationInMonths);

        // Format the end month date as required (YYYY-MM-DD for input type=date)
        var endMonthDate = currentDate.toISOString().slice(0, 10);
        $('#emi_end').val(endMonthDate);

        $('#disburment-modal').modal('show');


    });

    $('#reschedule').click(function(){
        var emiId = $(this).attr('data-emiId');

        console.log(emiId);

        $('#emi_id').val(emiId);


        $('#rescheduleModal').modal('show');

    })


});


document.getElementById('filterDropdown').addEventListener('change', function() {

    // console.log(this.value);
    var employeeId = this.value;
    if (employeeId && employeeId!=0) {
        // Redirect to the URL based on the selected employee ID
        window.location.href = '/loans?filter=' + employeeId;
    }
    else{
        window.location.href = '/loans';


    }
});
