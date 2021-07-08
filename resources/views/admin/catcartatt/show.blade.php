@extends('layout.master2')


@section('styles')
<style>


    body {
        font-family: 'tawajal', sans-serif
    }
</style>
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">


            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-block">

                        <div class="card-body">

                            <form id="add-form" action="/admin/catcart" method="post">
                                @csrf

                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-1 order-md-1 order-2">

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-4">اسم الصنف</label>
                                                <div class="col-sm-8"><input type="text" name="date"
                                                                             class="form-control bg-gray-light"
                                                                       value="{{$driver->name}}"      id="current-date"></div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-4">اسم المورد</label>
                                                <div class="col-sm-8"><select name="supplier"
                                                                              class="form-control bg-gray-light autocomplete_txt">
                                                        @foreach($suppliers as $supplier)
                                                            <option value="{{$supplier->id}}" @if($supplier->id==$driver->supplier_id)selected @endif>{{$supplier->name}}</option>


                                                        @endforeach

                                                    </select></div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-4"> رقم الصنف</label>
                                                <div class="col-sm-8"><input type="text" name="order" value="{{$driver->number}}"
                                                                             class="form-control bg-gray-light"></div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-4"> المجموعه</label>
                                                <div class="col-sm-8"><input type="text" name="registration_number" value="{{$driver->category}}"
                                                                             class="form-control bg-gray-light"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-1 text-center order-md-1 order-1">
                                            <img src="/assets/img/by-the-way-logo.png" alt="By The Way Logo"
                                                 class="brand-image mb-4">
                                            <h5 class="modal-title"> كارت الصنف</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card shadow-none m-0">
                                                <div class="card-body table-responsive p-0" style="height:250px;">
                                                    <table class="table table-head-fixed text-nowrap table-striped-td table-input-td text-center"
                                                           id="add-table">
                                                        <thead>
                                                        <tr>

                                                            <th>اسم الصنف</th>
                                                            <th>الكمية</th>
                                                            <th>الوحدة</th>
                                                            <th>  السعر الشراء</th>
                                                            <th>السعر البيع</th>
                                                            <th>الضريبه</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($products as $product)
                                                        <tr id="invoicerow_1">
                                                            <td>
                                                                {{$product->name}}
{{--                                                                <select data-type="name" required--}}
{{--                                                                        class="form-control bg-transparent border-0 inputs autocomplete_txt"--}}
{{--                                                                        id="name_1" onchange="selectProduct(this,1)"--}}
{{--                                                                        name="name[]" autocomplete="off">--}}

{{--                                                                        <option value="{{$product->id}}">{{$product->product->name}}</option>--}}

{{--                                                                </select>--}}
                                                            </td>
                                                            <td><input type="number" value="{{$product->qty}}" readonly
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
                                                                <input type="number" data-type="price"
                                                                       class="form-control bg-transparent border-0 inputs autocomplete_txt"
                                                                       readonly id="price_1" name="price[]" value="{{$product->purchase_price}}" readonly
                                                                       autocomplete="off">
                                                            </td>

                                                            <td>
                                                                <input type="number" data-type="price"
                                                                       class="form-control bg-transparent border-0 inputs autocomplete_txt"
                                                                       readonly id="price_1" name="sell_price[]" value="{{$product->sell_price}}" readonly
                                                                       autocomplete="off">
                                                            </td>
                                                            <td><input type="number"
                                                                       class="form-control bg-transparent border-0 totals inputs sal-lst" value="{{$product->tax}}"
                                                                       id="total_1" readonly name="tax[]"></td>
                                                            <td></td>
                                                        </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
                <!-- End Invoice Modal -->
                </section>


                <script src="/assets/vendor/jquery/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>

                <script>
                    var AddMultiAutoField = (function () {
                        var rowcount, html, tableBody, rowId;
                        rowcount = $("#add-table tbody tr").length + 1;
                        tableBody = $("#add-table tbody");
                        var accounts = <?php echo json_encode($products)?>;
                        var options = '';
                        options += '<option value="">المنتج</option>';

                        for (var i = 0; i < accounts.length; i++) {
                            options += '<option value="' + accounts[i].id + '">' + accounts[i].name + '</option>';

                        }

                        function formHtml(code) {
                            rowId = $("#add-table tbody tr").attr('id').split('_')[0];

                            if (code == 13 && rowId == 'invoicerow') {
                                html = '<tr id="invoicerow_' + rowcount + '" >';
                                html += '<td><select  data-type="name" required class="form-control bg-transparent border-0 inputs autocomplete_txt" onchange="selectProduct(this,' + rowcount + ')" id="name_' + rowcount + '" name="name[]" autocomplete="off">' +

                                    options +
                                    '</select></td>';
                                html += '<td><input type="number" value="1" class="form-control bg-transparent border-0 inputs" onchange="changeQuantity(this,' + rowcount + ')" id="quantity_' + rowcount + '" name="quantity[]"></td>';
                                html += '<td><select  data-type="unit" class="form-control bg-transparent border-0 inputs autocomplete_txt"  onchange="selectProduct(this,' + rowcount + ')" id="unit_' + rowcount + '" name="unit[]" autocomplete="off">' +
                                    '<option value="وحدة">    باكو/وحدة      </option>' +
                                    '<option value="علبة"> علبة </option>' +
                                    '<option value="كارتونة"> كارتونة </option>' +

                                    '</select></td>';
                                html += '<td><input type="number" data-type="price" class="form-control bg-transparent border-0 inputs autocomplete_txt" readonly id="price_' + rowcount + '" name="price[]" autocomplete="off"></td>';
                                html += '<td><input type="number" class="form-control bg-transparent border-0 inputs totals sal-lst" readonly id="total_' + rowcount + '" name="totals[]"></td>';
                                html += '<td class="p-0"><button type="button" onclick="removeRow(' + rowcount + ')" class="btn btn-rounded border-radius-left-0 btn-danger">حذف</button></td>';
                                html += '</tr>';
                                rowcount++;
                                return html;
                            }


                        }

                        function getFieldNo(type) {
                            var fieldNo;
                            switch (type) {
                                case 'name':
                                    fieldNo = 0;
                                    break;
                                case 'code':
                                    fieldNo = 1;
                                    break;
                                case 'unit':
                                    fieldNo = 2;
                                    break;
                                case 'price':
                                    fieldNo = 3;
                                    break;
                                default:
                                    break;
                            }
                            return fieldNo;
                        }

                        function handleMultiAutocomplete() {
                            var type, fieldNo, currentEle;
                            type = $(this).data('type');
                            fieldNo = getFieldNo(type);
                            currentEle = $(this);

                            if (typeof fieldNo === 'undefined') {
                                return false;
                            }

                            currentEle.autocomplete({
                                source: function (data, cb) {
                                    var result;
                                    result = [
                                        {
                                            label: 'There is matching record found for ' + data.term,
                                            value: ''
                                        }
                                    ];
                                    if (multiple.length) {
                                        var result = $.map(multiple, function (obj) {
                                            var arr = obj.split("|");
                                            return {label: arr[fieldNo], value: arr[fieldNo], data: obj};
                                        });
                                    }
                                    data.term, cb($.ui.autocomplete.filter(result, data.term));
                                },
                                autoFocus: true,
                                minLength: 1,
                                select: function (event, ui) {
                                    var resArr, rowNo;


                                    rowNo = getId(currentEle);
                                    resArr = ui.item.data.split("|");

                                    $('#name_' + rowNo).val(resArr[0]);
                                    $('#code_' + rowNo).val(resArr[1]);
                                    $('#unit_' + rowNo).val(resArr[2]);
                                    $('#price_' + rowNo).val(resArr[3]);
                                }
                            });
                        }

                        function getId(element) {
                            var id, idArr;
                            id = element.attr('id');
                            idArr = id.split("_");
                            return idArr[idArr.length - 1];
                        }

                        function addNewRow(code) {
                            $('#add-table').append(formHtml(code));
                            $('select').selectize({
                                sortField: 'text'
                            });
                        }

                        function deleteRow() {
                            $(this).closest('tr').remove();
                        }

                        function registerEvents() {
                            $('#add-table').on('keyup', '.sal-lst', function (e) {
                                var code = (e.keyCode ? e.keyCode : e.which);
                                addNewRow(code);
                            });

                            $('#add-table').on('keydown', '.inputs', function (e) {
                                var code = (e.keyCode ? e.keyCode : e.which);
                                if (code == 13) {
                                    var index = $('.inputs').index(this) + 1;
                                    $('.inputs').eq(index).focus();
                                }
                            });

                            $('#add-table').on('click', '.btn-danger', deleteRow);

                            $(document).on('focus', '.autocomplete_txt', handleMultiAutocomplete);

                            $(window).ready(function () {
                                $("#add-form").on("keypress", function (event) {
                                    var keyPressed = event.keyCode || event.which;
                                    if (keyPressed === 13) {
                                        event.preventDefault();
                                    }
                                });
                            });
                        }

                        function init() {
                            registerEvents();
                        }

                        return {
                            init: init
                        };
                    })();

                    $(document).ready(function () {
                        $("#accModal").modal('show');
                        AddMultiAutoField.init();
                    });

                    function selectProduct(element, row) {


                        $.ajax({
                            url: '/admin/getPrice/?id=' + $('#name_' + row).val() + '&type=' + $('#unit_' + row).val(),
                            type: 'get',
                            success: function (data) {

                                if (data == 0) {
                                    toastr.error('لا يوجد منتج بهذه الوحدة');

                                } else {
                                    $('#price_' + row).val(data);
                                    $('#total_' + row).val(data * $('#quantity_' + row).val());
                                    updateTotal();

                                }
                            }
                        });

                    }

                    function changeQuantity(element, row) {

                        if($('#price_' + row).val()!="") {

                            $('#total_' + row).val($('#price_' + row).val() * $('#quantity_' + row).val());
                            updateTotal();

                        }
                        else
                        {
                            toastr.error('لم يتم اختيار منتج');

                        }


                    }
                    function updateTotal() {
                      //  alert();
                       var total=0;
                        $('.totals').each(function() {
                            total+=parseFloat($(this).val());
                        });
                        var tax=total*5/100;

                        $('#total').val(total);
                        $('#tax').val(tax);
                        $('#final').val(parseFloat(tax)+parseFloat(total)-$('#discount').val());


                    }
                    function removeRow(row) {
                        $('#invoicerow_'+row).remove();
                        updateTotal();

                    }

                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('select').selectize({
                            sortField: 'text'
                        });
                    });
                </script>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('select').selectize({
                            sortField: 'text'
                        });
                    });
                </script></div>
@endsection
