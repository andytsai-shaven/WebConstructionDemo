<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>項次</th>
        <th>流程檢查項目</th>
    </tr>
    @foreach ($selfCheck['item_name'] as $idx => $itemName)
        <tr>
            <td>{{ $idx + 1 }}</td>
            <td>{{ $itemName }}</td>
            <td>{{ $selfCheck['item_details'][$idx] }}</td>
        </tr>
    @endforeach
</table>
