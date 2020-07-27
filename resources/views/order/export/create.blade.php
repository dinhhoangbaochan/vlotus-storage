@extends('layouts.app')

@section('content')
    
    <div class="row m-0">
        
        <div class="col-2 p-0">
            <div class="left_sidebar">
                @include('inc.sidebar')
            </div>
        </div>

        <div class="col-10 p-0">

            @include('inc.navbar')

            <div class="main_content">
                <input type="hidden" value name="productsInOrder" id="pio">

                    <div class="row">
                        
                        <div class="col-8">

                            <form id="formOne">
                                <div class="product_info">
                                    <div class="dropdown">
                                        <input type="text" class="w-100" id="look_for_product" name="findProducts" value="" placeholder="Nhập tên sản phẩm cần thêm vào đơn hàng">
                                        <div id="findProductList" class="dropdown-menu" aria-labelledby="">
                                        </div>
                                    </div>   
                                    

                                </div>
                            </form>
                        
                        <form id="formTwo">
                            <table class="lotus_table">
                                <thead>
                                    <tr>
                                        <th rowspan="1" colspan="1" style="width:100px">Image</th>
                                        <th rowspan="1" colspan="1">Sản phẩm</th>
                                        <th rospan="1" colspan="1">SKU</th>
                                        <th rowspan="1" colspan="1">Số lượng</th>
                                    </tr>
                                </thead>

                                <tbody class="LT_body">
                                    <tr></tr>
                                </tbody>

                            </table>
                        </form>


                        <input type="submit" value="Tạo đơn hàng" id="createOrderSubmit">

                        </div>

                        <div class="col-4">
                            <div class="product_info">
                                <div class="form-group">
                                    <label for="">Mã đơn hàng</label>
                                    <input type="text" name="order_code" id="order_code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="storage_location">Chọn chi nhánh</label>
                                    <select class="form-control" id="storage_location" name="storage_location">
                                        <option value="1">Nơ Trang Long</option>
                                        <option value="2">Tân Tạo</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="deadline_date">Ngày hẹn giao</label>
                                    {{Form::date('deadline', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
                                </div>
                            </div>
                        </div>
    


                    </div>

                    

                

            </div>

        </div>

    </div>
@endsection
