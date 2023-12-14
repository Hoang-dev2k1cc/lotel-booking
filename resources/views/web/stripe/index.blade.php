<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('template/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/payment.css') }}">
    <link rel="stylesheet" href="{{ asset('template/libries/fontawesome-free-6.4.0-web/css/all.css') }}">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h1 class="text-3xl md:text-5xl font-extrabold text-center uppercase mb-12 bg-gradient-to-r from-indigo-400 via-purple-500 to-indigo-600 bg-clip-text text-transparent transform -rotate-2">Trang thanh toán</h1>
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif

                <form action="{{ route('stripe.storePayment',['id'=>$pay->id]) }}" method="POST" id="card-form">
                    @csrf
                    <div class="mb-3">
                        <label for="card-name" class="">Tên của bạn</label>
                        <input type="text" name="name" id="card-name" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Tổng tiền</label>
                        <b type="email" name="email" id="email" class="form-control">{{$pay->sum_price}} &#8363;</b>
                    </div>
                    <div class="mb-3">
                        <label for="card" class="inline-block font-bold mb-2 uppercase text-sm tracking-wider">Card details</label>

                        <div class="form-control">
                            <div id="card"></div>
                        </div>
                    </div>
                    <button onclick="return confirm('Bạn có chắc muốn thanh toán không?')" type="submit" class="form-control button-pay">Xác nhận thanh toán 👉</button>
                </form>


            </div>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            let stripe = Stripe('{{ env("STRIPE_KEY") }}')
            const elements = stripe.elements()
            const cardElement = elements.create('card', {
                style: {
                    base: {
                        fontSize: '16px'
                    }
                }
            })
            const cardForm = document.getElementById('card-form')
            const cardName = document.getElementById('card-name')
            cardElement.mount('#card')
            cardForm.addEventListener('submit', async (e) => {
                e.preventDefault()
                const { paymentMethod, error } = await stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                    billing_details: {
                        name: cardName.value
                    }
                })
                if (error) {
                    console.log(error)
                } else {
                    let input = document.createElement('input')
                    input.setAttribute('type', 'hidden')
                    input.setAttribute('name', 'payment_method')
                    input.setAttribute('value', paymentMethod.id)
                    cardForm.appendChild(input)
                    cardForm.submit()
                }
            })
        </script>

    </div>

</body>

</html>
