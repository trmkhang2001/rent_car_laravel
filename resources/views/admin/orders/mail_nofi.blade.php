<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
</style>
<h2>Chúc mừng {{ $name }}</h2>
<p>Đơn hàng #{{ $order->id }} của bạn đã được đặt thành công ! Sản phẩm sẽ được chuyển đến bạn trong thời gian sớm
    nhất !</p>
<h3>Thông tin đặt hàng: </h3>
<p>Tên: {{ $order->name }}</p>
<p>Số điện thoại : {{ $order->phone }}</p>
<p>Gmail: {{ $order->mail }}</p>
<p>Địa chỉ: {{ $order->address }},{{ $order->ward }},{{ $order->district }},{{ $order->province }}.</p>
<h3>Thông tin đơn hàng</h3>
@foreach ($product as $item)
    <table>
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Mã sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ number_format($item->price) . ' VNĐ' }}</td>
            </tr>
        </tbody>
    </table>
@endforeach
<h3>Tổng giá trị đơn hàng: {{ number_format($order->total) . ' VNĐ' }}</h3>
<p> <a href="http://127.0.0.1:8000/">Theo dõi tình trạng đơn hàng tại trang !</a></p>
