<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Page</title>
</head>
<body style="background: white">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data">
                        
                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                            <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
                            <script>
                                CKEDITOR.replace( 'content' );
                            </script>
                        
                        
                            <h3>Booking ID: {{ $booking->id }}</h3>
                            <p>Total Amount: {{ $booking->total_cost }}</p>
                            <p>Status Pembayaran: {{ $booking->payment_status ?? 'Belum Dibayar' }}</p>
                        
                            <form action="https://app.sandbox.midtrans.com/snap/v1/transactions" method="POST" id="payment-form">
                                <input type="hidden" name="token" id="snap_token" value="{{ $snapToken }}"/>
                                <button type="submit">Bayar Sekarang</button>
                            </form>
                        
                            <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
                            <script>
                                document.getElementById('payment-form').onsubmit = function (e) {
                                    e.preventDefault();
                                    snap.pay(document.getElementById('snap_token').value, {
                                        onSuccess: function (result) {
                                            alert('Payment successful');
                                            window.location.href = '/payment/success';
                                        },
                                        onPending: function (result) {
                                            alert('Waiting for payment confirmation');
                                        },
                                        onError: function (result) {
                                            alert('Payment failed');
                                        }
                                    });
                                };
                            </script>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>
