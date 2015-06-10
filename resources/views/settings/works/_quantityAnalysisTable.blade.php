<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>項目名稱</th>
        <th>單位</th>
    </tr>
    @foreach ($quantityAnalysis['item_name'] as $idx => $itemName)
        <tr>
            <td>{{ $idx + 1 }}</td>
            <td>{{ $itemName }}</td>
            <td>{{ $quantityAnalysis['item_unit'][$idx] }}</td>
        </tr>
    @endforeach
</table>
