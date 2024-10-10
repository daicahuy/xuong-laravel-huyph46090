@extends('master')

@section('content')
    <h2 class="text-center">List Transaction</h2>
    <div class="mb-4">
        <a href="{{ route('transaction.step1') }}" class="btn btn-success" id="btnNewTransaction">New transaction</a>
        <a href="{{ route('transaction.listUnfinished') }}" class="btn btn-warning" id="btnViewTransactionUnfinished">Transaction Unfinished</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Receiver Account</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ID</td>
                <td>Amount</td>
                <td>Receiver Account</td>
                <td>Status</td>
            </tr>
        </tbody>
    </table>
    
    <script>
        const btnViewTransactionUnfinished = document.querySelector('#btnViewTransactionUnfinished');
        const btnNewTransaction = document.querySelector('#btnNewTransaction');
        
        @if (session()->has('transaction'))
            if (confirm('Have 1 transaction unfinished, Go to view') == true) {
                btnViewTransactionUnfinished.click();
            }
        @endif

        btnNewTransaction.onclick = function(event) {
            event.preventDefault();
            if ({{ session()->has('transaction') }}) {
                alert('You have 1 transaction unfinished')
            }
            else {
                btnNewTransaction.click();
            }
        }
    </script>
    
@endsection