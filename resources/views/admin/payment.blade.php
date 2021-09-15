@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center  mb-5">
        <div class="col-md-8">
            <div class="card p-4">

                <form method="post" id="myform" action="{{ route('payment.store') }}">
                    <div class="form-group">
                        @csrf

                        <label for="name">Total Pembayaran</label>
                        <input type="text" id="total_bonus" class="form-control col-md-4" name="total_bonus" />
                    </div>
                    <table class="table table-borderless ml-n2" id="dynamicAddRemove">

                        <tr>
                            <td> <label for="name">Nama Buruh</label> <input type="text" id="nama-0"
                                    name="buruh[0][nama]" placeholder="Masukkan Nama Buruh"
                                    class="form-control myname" />
                            </td>
                            <td><label for="name">Persentasi (%)</label><input type="text" id="bonus-0"
                                    name="buruh[0][bonus]" onchange="bonusFunction('0')"
                                    placeholder="Masukkan Nama Bonus" class="form-control mybonus" />
                            </td>
                            <td>
                                <label for="name">Expected</label>
                                <span id="preview-0" class=" mt-4">
                                    <p>Rp. 0</p>
                                </span>
                            </td>
                            <td><button type="button" name="add" id="dynamic-ar"
                                    class="btn btn-outline-primary mt-4">Add
                                </button></td>
                        </tr>
                    </table>
                    <button id="mybutton" type="button" class="btn btn-block btn-primary col-md-6">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <table class="table table-bordered mb-5">
                <thead>
                    <tr class="table-success">
                        <th scope="col">No</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Data Buruh</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr>

                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ 'Rp. ' .number_format($payment->payment_total,0) }}</td>
                        <td>
                            @foreach( $payment->payment_detail as $detail)
                            Nama : {{ $detail->laborer_name }} , Bonus : Rp. {{
                            number_format($payment->payment_total*($detail->persentase/100), 0) }} <br>

                            @endforeach
                        </td>

                        <td>
                            @if (Auth::user()->is_admin == 1)
                            <a href=""></a>
                            <a href="" id="editPayment" data-toggle="modal" class="btn btn-primary btn-sm"
                                data-target='#payment_modal' data-id="{{ $payment->id }}">Edit</a>
                            <form action=" {{ route('payment.destroy', $payment->id)}}" method="post" style="display:
                                inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" type=" submit">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="modal fade" id="payment_modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Data</h5>

                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" id="payment_data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="payment_id" name="payment_id" value="">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="name">Total Pembayaran Bonus</label>
                                        <input type="text" name="payment_total" id="payment_total" value=""
                                            class="form-control">
                                    </div>
                                    <div id="detail_data">

                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">

                            <button type="submit" value="Submit" id="submit" class="btn btn-primary">Save
                                changes</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection