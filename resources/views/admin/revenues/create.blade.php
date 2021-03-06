@extends('layout.master2')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2">
                <h3 class="content-header-title font-theme ls-0">إضافة ايراد</h3>
            </div>
        </div>
        <div class="content-body">
            <div class="card">
                <div class="card-block">
                    <div class="card-body">
                        <form method="post" action="{{route('revenues.store')}}" enctype="multipart/form-data">
                            @csrf()
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Branches</label>
                                        <select name="branch_id"  id="country" required onchange="updateSelectCountry()"   class="form-control">
                                            <option disabled selected>Choose Branch</option>
                                            @foreach($branches as $branch)
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Accounts</label>
                                        <select name="account_id"  id="c_clinicProvinces" class="form-control">
                                            @foreach(\App\Account::get() as $value)
                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Net Sales</label>
                                        <input type="text" name="net_sales"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vat is</label>
                                        <input type="text" name="vat"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Salled</label>
                                        <input type="text" name="total_sales"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Master Card</label>
                                        <input type="text" name="master_card"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Spain</label>
                                        <input type="text" name="span"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Visa</label>
                                        <input type="text" name="visa"required class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>STC</label>
                                        <input type="text" name="stc"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Wassel</label>
                                        <input type="text" name="wassel"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>To You</label>
                                        <input type="text" name="to_you"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Hunger Sta Shion</label>
                                        <input type="text" name="hunger"required class="form-control">
                                    </div>
                                </div>  <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Atm</label>
                                        <input type="text" name="total_atm"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Royality fee</label>
                                        <input type="text" name="fee"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Markiting</label>
                                        <input type="text" name="markiting"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total fee</label>
                                        <input type="text" name="total_fee"required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Advanced</label>
                                        <input type="text" name="advansed"required class="form-control">
                                    </div>
                                </div><div class="col-md-6">
                                    <div class="form-group">
                                        <label>Cash Saled of day</label>
                                        <input type="text" name="cash_day"required class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12">
                                    <button type="submit"  class="btn btn-primary"><i class="icon-plus"></i> إضافة</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->
<script>
    function updateSelectCountry() {
        var country = $('#country').val();
        var option = '<option selected="true" value="" disabled="disabled">Choose Account</option>';
        $.ajax({
            url: 'https://accountant.3codeit.com/updateSelectCountry/' + country,
            type: 'get',
            success: function (data) {
                if (data == 0) {
                    // toastr.warning('no cities for this country');
                    $('#c_clinicProvinces').empty();
                    $('#c_clinicProvinces').append(option);

                } else {
                    $('#c_clinicProvinces').empty();
                    for (var x = 0; x < data.length; x++) {
                        option += '<option value="' + data[x].id+'">' + data[x].name+'</option>';
                    }
                    $('#c_clinicProvinces').append(option);
                }
            }
        });
    }
</script>
@endsection
