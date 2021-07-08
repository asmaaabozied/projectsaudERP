<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pages</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/frontstyle/css/all.min.css">
    <link rel="stylesheet" href="/frontstyle/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="/frontstyle/css/style.css">
</head>
<body>
<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary fBtn" data-toggle="modal" data-target="#modal1">--}}
{{--    open--}}
{{--</button>--}}

<!-- Modal -->
<div class="row">
    {{--<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">--}}
    {{--    <div class="modal-dialog" role="document">--}}
    <div class="col-lg-12">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal1Label">
                    <span>EVEREST</span>
                    <span>الفرع: فرع الرياض</span>
                    <span> التاريخ :01/03/2021</span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-10 modItmDiv">
                        <button class="modItm" type="button" data-toggle="modal" data-target="#sales">
                            <img src="/frontstyle/img/sales.png" alt="">
                            <h4>sales</h4>
                        </button>
                        <button class="modItm" type="button" data-toggle="modal" data-target="#exp">
                            <img src="/frontstyle/img/expenses.png" alt="">
                            <h4>expences</h4>
                        </button>
                        <button class="modItm" type="button" data-toggle="modal" data-target="#invoice">
                            <img src="/frontstyle/img/invoice.png" alt="">
                            <h4>invoice</h4>
                        </button>
                        <button class="modItm">
                            <img src="/frontstyle/img/salary.png" alt="">
                            <h4>salary</h4>
                        </button>
                        <button class="modItm">
                            <img src="/frontstyle/img/mentain.png" alt="">
                            <h4>mentinance</h4>
                        </button>
                        <button class="modItm">
                            <img src="/frontstyle/img/report.png" alt="">
                            <h4>report</h4>
                        </button>
                    </div>
                    <div class="col-md-2 lefBords">
                        <h5>total</h5>
                        <h6>5000</h6>
                        <h5>expense</h5>
                        <h6>4000</h6>
                        <h5>sales</h5>
                        <h6>3000</h6>
                        <h5>gross</h5>
                        <h6>2000</h6>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn"><a href="{{route('users.index')}}"> create user</a></button>
                <button type="button" class="btn"><a href="{{route('company.index')}}"> create company</a></button>
                <button type="button" class="btn modItm" data-toggle="modal" data-target="#exp">create expense</button>
            </div>
        </div>
    </div>
</div>
<!-- invoice -->
<div class="modal fade" id="invoice" tabindex="-1" role="dialog" aria-labelledby="invoiceLabel" aria-hidden="true">
    <form action="{{route('admin.branchpurchases.store')}}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headItmsDiv">
                        <div class="headItm">
                            <input type="text" name="registration_number" id="" class="form-control"
                                   placeholder=" رقم الفاتوره">
                            <select name="branch_id" id="" class="form-control form-control-sm" required>
                                <option> اختار الفرع</option>
                                @foreach(\App\Branches::get() as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>
                            <select name="store_id" id="" class="form-control form-control-sm" required>
                                <option> اختار المخرن</option>
                                @foreach(\App\Store::get() as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="headItm">
                            <img src="/frontstyle/img/gg.png" alt="">
                            <h3>daily invoice record</h3>
                        </div>
                        <div class="headItm">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">التاريخ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="date1" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">المورد</label>
                                <div class="col-sm-10">
                                    <select name="supplier_id" id="" class="form-control form-control-sm" required>
                                        @foreach(\App\Suppliers::get() as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">نوع الفاتوره</label>
                                <div class="col-sm-10">
                                    <select name="type" id="" class="form-control form-control-sm" required>

                                        <option value="نقدي">نقدى</option>
                                        <option value="فيزا">فيزا</option>

                                        <option value="اجل">اجل</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table invoiceTbl table-responsive-lg table-bordered">
                        <tbody>
                        <tr>
                            <td>delete</td>
                            <td>date</td>
                            <td>number</td>
                            <td>after tax</td>
                            <td>value tax</td>
                            <td>tax</td>
                            <td>amount</td>
                            <td>company</td>
                        </tr>
                        <tr>
                            <td><a href=""><i class="far fa-trash-alt"></i></a></td>
                            <td><input type="text" name="date[]" required></td>
                            <td><input type="text" name="number[]" required></td>
                            <td><input type="text" name="aftertax[]" required></td>
                            <td><input type="text" name="valuetax[]" required></td>
                            <td><select name="tax[]" id="" required>
                                    <option value="1">yes</option>
                                    <option value="0">no</option>
                                </select></td>
                            <td><input type="text" name="amount[]" required></td>
                            <td><input type="text" name="company[]" required></td>
                        </tr>
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button class="btn addBtn" type="submit">add <i class="far fa-save"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- sales -->
<div class="modal fade" id="sales" tabindex="-1" role="dialog" aria-labelledby="salesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="headItmsDiv">
                    <div class="headItm">
                        <input type="text" placeholder="60/09/2021" readonly class="form-control">
                        <select name="" id="" class="form-control form-control-sm">
                            <option value="">-----</option>
                            <option value="">-----</option>
                            <option value="">-----</option>
                        </select>
                        <select name="" id="" class="form-control form-control-sm">
                            <option value="">-----</option>
                            <option value="">-----</option>
                            <option value="">-----</option>
                        </select>
                    </div>
                    <div class="headItm">
                        <img src="/frontstyle/img/gg.png" alt="">
                        <!-- <h3>daily invoice record</h3> -->
                    </div>
                    <div class="headItm">
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <select name="" id="" class="form-control form-control-sm">
                                    <option value="">-----</option>
                                    <option value="">-----</option>
                                    <option value="">-----</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="bBg">sales daily</h4>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-responsive-lg table-bordered colrdTbl">
                            <tbody>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>pety cash</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>bank</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-responsive-lg table-bordered colrdTbl">
                            <tbody>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>total sales</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>tax</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>total</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>hunger station</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>to you</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>wasal</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>jahez</td>
                            </tr>
                            <tr>
                                <td><input type="text" name="" id=""></td>
                                <td>total</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn addBtn">add <i class="far fa-save"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- exp -->
<div class="modal fade" id="exp" tabindex="-1" role="dialog" aria-labelledby="expLabel" aria-hidden="true">
    <form action="{{route('admin.branchexperences.store')}}" method="post">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="headItmsDiv">
                        <div class="headItm">
                            <input type="text" name="registration_number" id="" class="form-control"
                                   placeholder=" رقم ">
                            <select name="branch_id" id="" class="form-control form-control-sm" required>
                                <option> اختار الفرع</option>
                                @foreach(\App\Branches::get() as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach

                            </select>
                            <select name="store_id" id="" class="form-control form-control-sm" required>
                                <option> اختار المخرن</option>
                                @foreach(\App\Store::get() as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="headItm">
                            <img src="/frontstyle/img/gg.png" alt="">
                            <h3>daily Expences record</h3>
                        </div>
                        <div class="headItm">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">التاريخ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="date1" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label">المورد</label>
                                <div class="col-sm-10">
                                    <select name="supplier_id" id="" class="form-control form-control-sm" required>
                                        @foreach(\App\Suppliers::get() as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table invoiceTbl table-responsive-lg table-bordered" id="addtable">
                        <tbody>
                        <tr>
                            <td>delete</td>
                            <td>date</td>
                            <td>number</td>
                            <td>after tax</td>
                            <td>value tax</td>
                            <td>tax</td>
                            <td>amount</td>
                            <td>company</td>
                            <td>add</td>

                        </tr>
                        <tr class="newss">
                            <td><a href=""><i class="far fa-trash-alt"></i></a></td>
                            <td><input type="text" name="date[]" required></td>
                            <td><input type="text" name="number[]" required></td>
                            <td><input type="text" name="aftertax[]" required></td>
                            <td><input type="text" name="valuetax[]" required></td>
                            <td><select name="tax[]" id="" required>
                                    <option value="1">yes</option>
                                    <option value="0">no</option>
                                </select></td>
                            <td><input type="text" name="amount[]" required></td>
                            <td><input type="text" name="company[]" required></td>
                            <td>
                                <button type="button" class="addnew btn btn-primary"  onclick="addNewdata()">
                                    add
                                </button>
                            </td>

                        </tr>
                        <tr calss="tablesadd"></tr>
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        {{--                    <tr>--}}
                        {{--                        <td><a href="" ><i class="far fa-trash-alt"></i></a></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><select name="" id="">--}}
                        {{--                                <option value="">yes</option>--}}
                        {{--                                <option value="">no</option>--}}
                        {{--                            </select></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                        <td><input type="text"></td>--}}
                        {{--                    </tr>--}}
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn addBtn">add <i class="far fa-save"></i></button>
                </div>
            </div>
        </div>
    </form>
</div>


<script>
    function addNewdata() {


        // var html = '<div class="modal-body">';
        // html += '<table class="table invoiceTbl table-responsive-lg table-bordered"> <tbody>';
        //
        // html += '<td><a href=""><i class="far fa-trash-alt"></i></a></td>';
        // html += '<td><input type="text" name="date[]" required></td>';
        // html += '<td><input type="text" name="number[]" required></td>';
        // html += '<td><input type="text" name="aftertax[]" required></td>';
        // html += '<td><input type="text" name="valuetax[]" required></td>';
        // html += '<td><select name="tax[]" id="" required>';
        // html += '<option value="1">yes</option>';
        // html += ' <option value="0">no</option>';
        // html += '</select></td>';
        // html += '<td><input type="text" name="amount[]" required></td>';
        // html += '<td><input type="text" name="company[]" required></td>';
        // html += '<td>';
        // html += ' <button type="button" class="addnew btn btn-primary" >add</button></td>';
        //
        //
        // html += '</body></table></div>';

        // $('.tablesadd').append(html);
        // $('.newss').show();

    }


    $("#addnew").click(function () {

        var html = '<div class="modal-body">';
        html += '<table class="table invoiceTbl table-responsive-lg table-bordered" id="addtable"> <tbody><tr>';

        html += '</div>';

        $('.newss').append(html);
    });
</script>

<script src="/frontstyle/js/jquery-3.5.1.min.js"></script>
<script src="/frontstyle/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
    // add row
    $("#add").click(function () {
        var $self = $(this);
        var x = $('#example tbody tr:first-child').clone();
        // var x= $self.parent().clone();
        $('#example tbody').append(x);
    });
    $(document).ready(function () {
        $docH = $(document).height();
        $('.sidebar').css('height', $docH)
    });

</script>
</body>
</html>
