<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice Printing | Vdoo ERP</title>
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">
    <style>
        @font-face{
            font-family: kh;
            src: url('{{asset('fonts/KhmerOSmuollight.ttf')}}');
        }
        @font-face{
            font-family: kh1;
            src: url('{{asset('fonts/KhmerOSsiemreap.ttf')}}');
        }
        .khmoul{
            font-family: kh;
        }
        .kh{
            font-family: kh1;
        }
        th, td, div, p, span, label{
            font-family: kh1;
        }
        .p1{
            font-size: 11px;
        }
        .mytbl td{
            font-size: 12px;
        }
        .item-tbl{
            border: 1px solid #aaa;
            width: 100%;
        }
        .item-tbl thead tr th{
            font-size: 11px;
            text-align: center;
            border-bottom: 1px solid #aaa;
            border-right: 1px solid #aaa;
            padding: 4px 1px;
        }
        .item-tbl thead tr th:last-child{
            border-right: none;
        }
        .item-tbl tbody tr td{
            border-bottom: 1px solid #aaa;
            border-right: 1px solid #aaa;
            font-size: 11px;
            padding: 2px 3px;
        }
    </style>
</head>
<body>
    <div class="container" style="width:100%!important">
        <table width="100%" border="0">
            <tr>
                <td style="width: 110px" class='text-left'>
                    <img src="{{asset($com->logo)}}" alt="" width="100">
                </td>
                <td class='text-center'>
                    <p></p>
                    <h4 class="khmoul">{{$com->kh_name}}</h4>
                    <h5>{{$com->en_name}}</h5>
                    <p class="p1">
                        <span style="color:#fff">.</span>{{$com->address}} <br>
                        {{$com->header}} <br>

                        Website: {{$com->website}} / Email: {{$com->email}} <br>
                        Telephone: {{$com->phone}}
                    </p>
                </td>
                <td style='width:100px'></td>
            </tr>

        </table>

        <hr>
        <p class="text-center">
            <u><strong>វិក័យបត្រ (Invoice)</strong></u>
        </p>
        <table width="100%" class="mytbl" style="border: 1px solid #aaa; border-radius: 4px;" cellpadding="4">
            <tr>
                <td>
                        <table>
                            <tr>
                                <td width="100">
                                    ឈ្មោះក្រុមហ៊ុន
                                </td>
                                <td width="15">:</td>
                                <td>{{$invoice->company_name}}</td>
                            </tr>
                            <tr>
                                <td>
                                    Company Name
                                </td>
                                <td>:</td>
                                <td>{{$invoice->en_name}}</td>
                            </tr>
                            <tr>
                                <td>អាសយដ្ឋាន</td>
                                <td>:</td>
                                <td>{{$invoice->address}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td>{{$invoice->en_address}}</td>
                            </tr>
                            <tr>
                                <td>ទូរស័ព្ទ(Tel)</td>
                                <td>:</td>
                                <td>{{$invoice->phone}}</td>
                            </tr>
                            <tr>
                                <td>លេខ VATIN</td>
                                <td>:</td>
                                <td>{{$invoice->vatin}}</td>
                            </tr>
                        </table>
                </td>
                <td style="width:27px; border-left: 1px solid #aaa;">
                  &nbsp;
                </td>
                <td width="40%">
                        <table>
                            <tr>
                                <td width="100">
                                    លេខវិក័យបត្រ <br>
                                    Invoice #.
                                </td>
                                <td width="15">:</td>
                                <td>INV00{{$invoice->id}}</td>
                            </tr>
                            <tr>
                                <td>
                                    កាលបរិច្ឆេទ <br>
                                    Date
                                </td>
                                <td>:</td>
                                <td>{{$invoice->invoice_date}}</td>
                            </tr>
                            <tr>
                                <td>Ref. / PO.</td>
                                <td>:</td>
                                <td>{{$invoice->reference}}</td>
                            </tr>
                            <tr>
                                <td colspan="3">&nbsp;</td>
                            </tr>

                        </table>
                </td>

            </tr>
        </table>
       <p>
            <strong>មុខទំនិញ / Items</strong>
       </p>
        <table class="item-tbl">
            <thead>
                <tr>
                    <th>ល.រ <br> &numero;</th>
                    <th>បាកូដ <br>Barcode</th>
                    <th>កូដទំនិញ <br>Code</th>
                    <th>មុខទំនិញ <br>Item Name</th>
                    <th>បរិមាណ <br>QTY</th>
                    <th>ខ្នាតទំនិញ <br>UoM</th>
                    <th>តម្លៃឯកតា <br>Unit Price</th>
                    <th>តម្លៃសរុប <br>Amount</th>
                </tr>
            </thead>
            <tbody>
                @php($i=1)
                @php($disc=0)
                @php($total=0)
                @foreach($items as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$p->barcode}}</td>
                        <td>{{$p->code}}</td>
                        <td>{{$p->kh_name}} <br> {{$p->name}}</td>
                        <td>{{$p->quantity}}</td>
                        <td>{{$p->uname}}</td>
                        <td>${{$p->unitprice}}</td>
                        <td>${{$p->quantity * $p->unitprice}}</td>
                    </tr>
                   <?php
                        $total += ($p->quantity * $p->unitprice);
                   ?>
                @endforeach

                    <tr>
                        <td rowspan="5" colspan="5">
                          អត្រាប្តូរប្រាក់សម្រាប់ថ្ងៃ {{date_format(date_create($invoice->invoice_date), 'd-m-Y')}} យកតាមធនាគារជាតិ <br>
                          1$=KHR{{$invoice->exchange}}
                        </td>
                        <td colspan="2">
                            <strong>សរុប (Total)</strong>
                        </td>
                        <td>
                            <strong>$ {{$total}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>បញ្ចុះតម្លៃ ({{$invoice->discount}}%)</strong>
                        </td>
                        <td>
                            <strong>$ {{number_format($total * $invoice->discount/100, 2)}}</strong>
                        </td>
                    </tr>
                    @if($invoice->vat>0)

                        <tr>
                            <td colspan="2">
                                <strong>VAT ({{$invoice->vat}}%)</strong>
                            </td>
                            <td>
                                <strong>$ {{$invoice->vat_amount}}</strong>
                            </td>
                        </tr>

                    @endif
                    <tr>
                        <td colspan="2">
                            <strong>សរុបរួម</strong>
                        </td>
                        <td>
                            <strong>$ {{$invoice->grand_total}}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <strong>សរុបជាប្រាក់រៀល (KHR)</strong>
                        </td>
                        <td>
                            <strong>{{$invoice->exchange * ($invoice->grand_total)}} រៀល</strong>
                        </td>
                    </tr>
            </tbody>
        </table>
        <p>
            <strong><u>Condition</u></strong>
            <br>
            {!!$invoice->payment_term!!}
        </p>
        <p>&nbsp;</p>
        <table width="100%">
            <tr>
                <td class='text-center' width="33%">

                    _____________________ <br>
                    <span class="small">
                        ហត្ថលេខា និងឈ្មោះអ្នកទិញ <br>
                        Customer's Signature & Name
                    </span>
                </td>
                <td width="34%" class="text-center">
                    ______________________ <br>
                    <span class="small">
                        ហត្ថលេខា និងឈ្មោះអ្នកដឹកជញ្ជួន <br>
                        Delivery's Signature & Name
                    </span>
                </td>
                <td class='text-center' width="33%">

                    _____________________ <br>
                    <span class="small">
                        ហត្ថលេខា និងឈ្មោះអ្នកលក់ <br>
                        Seller's Signature & Name
                    </span>
                </td>
            </tr>
        </table>


    </div>
    <script>
        print();
    </script>
</body>
</html>
