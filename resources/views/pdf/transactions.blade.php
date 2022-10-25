<!DOCTYPE html>
<html>
    <head>
        <style>
            #customers {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #04AA6D;
                color: white;
            }
        </style>
    </head>
<body>

<h1>ZBC Transaction Report</h1>

<table id="customers">
    <tr>
        <th>Reference</th>
        <th>Account</th>
        <th>Activity</th>
        <th>Method</th>
        <th>Amount</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
    @foreach ($transactions as $item)
        <tr>
            <td>{{ $item->reference }}</td>
            <td>{{ get_account_number($item->user_id) }}</td>
            <td>{{ $item->action }}</td>
            <td>{{ $item->method }}</td>
            <td>{{ $item->amount }}</td>
            <td>{{ get_trans_status($item->status)->label }}</td>
            <td>{{ $item->created_at }}</td>
        </tr>
    @endforeach
</table>

</body>
</html>


