<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @guest
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('payment.index') }}">{{ __('Coding Challenge')
                                }}</a>
                        </li>
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
        var i = 0;
        $("#dynamic-ar").click(function () {
            ++i;
            var mybonus = `'${i}'`;
            $("#dynamicAddRemove").append('<tr><td><input type="text" id="nama-' + i + '"  name="buruh[' + i +
                '][nama]" placeholder="Masukkan Nama Buruh" class="form-control myname" /></td><td><input type="text" onchange="bonusFunction(' + mybonus + ')" id="bonus-' + i + '" name="buruh[' + i +
                '][bonus]" placeholder="Masukkan Persentse Bonus" class="form-control mybonus" /></td><td><span id="preview-' + i + '"class=" mt-4"> </span></td><td><button type="button" class="btn btn-outline-danger remove-input-field">Delete</button></td></tr>'
            );
        });
        $(document).on('click', '.remove-input-field', function () {
            $(this).parents('tr').remove();
        });

        function bonusFunction(val) {
            var mybonus = $('#total_bonus').val();
            var persen = $(`#bonus-${val}`).val();
            var total = mybonus * (persen / 100);

            total = new Number(total).toLocaleString("id-ID");

            $(`#preview-${val}`).html(`<p class='mt-2'>Rp. ${total}</p>`);
        }

        $('#mybutton').click(function () {
            var total = 0;
            var myindex = 0;
            $('.mybonus').each(function (index, element) {
                myindex = index + 1;
                total = total + parseFloat($(element).val());
            });
            if (myindex > 2) {
                if (total != 100) {
                    alert("Total Persentasi Harus 100 %");
                } else {
                    $('#myform').submit();
                }

            } else {
                alert('Data Buruh Minimal 3');
            }



        })
    </script>
    <script>
        $(document).ready(function () {



            $('body').on('click', '#editPayment', function (event) {

                event.preventDefault();
                var id = $(this).data('id');
                console.log(id)
                $.get('payment/' + id + '', function (data) {
                    console.log(data.detail);
                    $('#userCrudModal').html("Edit category");
                    $('#submit').val("Edit Bonus");
                    $('#payment_modal').modal('toggle');

                    let url = "{{ route('payment.edit', ':id') }}";
                    url = url.replace(':id', id);
                    console.log(url);
                    $('#payment_data').attr('action', `${url}`);
                    $('#payment_id').val(data.data.id);
                    $('#detail_data').empty();
                    for (let index = 0; index < data.detail.length; index++) {
                        $('#detail_data').append('<div class="form-group"><input type="hidden" id="dataid[' + data.detail[index].id + ']" name="dataid[' + index + ']" value="' + data.detail[index].id + '"><label for="name">' + data.detail[index].laborer_name + '</label><input type="text" name="databuruh[' + index + ']" value="' + data.detail[index].persentase + '" id="payment_total"class="form-control "></div>');
                    }


                    $('#payment_total').val(data.data.payment_total);
                })
            });

        });
    </script>
</body>

</html>