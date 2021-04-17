<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Order</title>
</head>
<body>
    <table class="minimalistBlack">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Unit Price (Rs)</th=>
                <th>Total Cost (Rs)</th=>
            </tr>
        </thead>
        <tbody>        
            @foreach ($materials as $material)
                <tr>
                    <td>1</td>
                    <td>{{$material->item->name}}</td>
                    <td>{{$material->quantity}}</td>
                    <td>{{$material->item->price * $material->quantity}}</td>
                    <td>{{$material->cost}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>

