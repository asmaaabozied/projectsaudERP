
<!DOCTYPE html>

<html>

<head>
{{--    <meta http-equiv='Content-Type' content='text/html; charset=windows-1256'/>--}}
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

    {{--    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>--}}
</head>
<style>

    body {
        font-family: 'tawajal', sans-serif
    }
</style>

<body>

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">


        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">

                    <div class="card-body">


                        <div class="modal-body">
                            <div class="row container" >
                                <div class="col-md-4 mb-1 order-md-1 order-2">

                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">التاريخ</label>
                                        <div class="col-sm-8"><input type="text" name="date"
                                                                     class="form-control bg-gray-light"
                                                                     value="{{$driver->date}}" id="current-date"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">امر التحصيل</label>
                                        <div class="col-sm-8"><input type="text" name="order" value="{{$driver->order}}"
                                                                     class="form-control bg-gray-light"></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">رقم القيد</label>
                                        <div class="col-sm-8"><input type="text" name="registration_number"
                                                                     value="{{$driver->registration_number}}"
                                                                     class="form-control bg-gray-light"></div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-1 text-center order-md-1 order-1">
                                    <img src="/assets/img/by-the-way-logo.png" alt="By The Way Logo"
                                         class="brand-image mb-4">
                                    <h5 class="modal-title">فاتورة المشتريات</h5>
                                </div>
                                <div class="col-md-4 mb-1 order-md-1 order-3">
                                    <div class="form-group row">&nbsp;</div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4">نوع الفاتورة</label>
                                        <div class="col-sm-8">

                                        </div>
                                    </div>


                                </div>
                            </div>



                            <div class="row container">
                                <div class="col-12">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body table-responsive p-0" style="height:250px;">
                                            <table style="width:100%;" border="6">

                                                <thead>
                                                <tr>

                                                    <th>اسم الصنف</th>
                                                    <th>الكمية</th>
                                                    <th>الوحدة</th>
                                                    <th>السعر</th>
                                                    <th>الاجمالى</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($products as $product)
                                                    <tr id="invoicerow_1">
                                                        <td>

                                                        </td>
                                                        <td><input type="number" value="{{$product->quantity}}" readonly
                                                                   class="form-control bg-transparent border-0 inputs"
                                                                   id="quantity_1" onchange="changeQuantity(this,1)" name="quantity[]"></td>
                                                        <td><select data-type="unit"
                                                                    class="form-control bg-transparent border-0 inputs autocomplete_txt"
                                                                    id="unit_1" onchange="selectProduct(this,1)"
                                                                    name="unit[]" autocomplete="off">
                                                                <option value="وحدة" @if($product->unit=="وحدة") selected @endif> باكو/وحدة</option>
                                                                <option value="علبة" @if($product->unit=="علبة") selected @endif>علبة</option>
                                                                <option value="كارتونة" @if($product->unit=="كارتونة") selected @endif>كارتونة</option>

                                                            </select></td>
                                                        <td>
                                                            {{--                                                                <input type="number" data-type="price"--}}
                                                            {{--                                                                       class="form-control bg-transparent border-0 inputs autocomplete_txt"--}}
                                                            {{--                                                                       readonly id="price_1" name="price[]" value="{{$product->product->price_system}}" readonly--}}
                                                            {{--                                                                       autocomplete="off">--}}
                                                        </td>
                                                        <td><input type="number"
                                                                   class="form-control bg-transparent border-0 totals inputs sal-lst" value="{{$product->total}}"
                                                                   id="total_1" readonly name="totals[]"></td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <center>
                            <div class="row container">
                                <div class="col-md-8"></div>
                                <div class="col-md-4">
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4 font-weight-bold">الاجمالى</label>
                                        <div class="col-sm-8"><input type="text" id="total" readonly name="total" value="{{$driver->total -$driver->tax + $driver->discount }}"
                                                                     class="form-control bg-gray-light"/></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4 font-weight-bold">الخصم</label>
                                        <div class="col-sm-8"><input type="text"  id="discount" name="discount" value="{{$driver->discount}}"
                                                                     class="form-control bg-gray-light"/></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4 font-weight-bold">الضريبة</label>
                                        <div class="col-sm-8"><input type="text" id="tax" readonly name="tax" value="{{$driver->tax}}"
                                                                     class="form-control bg-gray-light"/></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label col-sm-4 font-weight-bold">المبلغ بعد
                                            الضريبة</label>
                                        <div class="col-sm-8"><input type="text"  id="final" readonly name="final" value="{{$driver->total}}"
                                                                     class="form-control bg-gray-light"/></div>
                                    </div>

                                </div>
                            </div>

                            </center>


                        </div>

                    </div>
                </div>
            </div>

            <!-- End Invoice Modal -->





        </div>
    </div>
</div>

</body>
</html>

