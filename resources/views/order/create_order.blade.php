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
                <form id="findProducts">

                    <div class="dropdown">
                        <input type="text" class="w-100" id="look_for_product" name="findProducts" value="" placeholder="Nhập tên sản phẩm cần thêm vào đơn hàng">
                        <div id="findProductList" class="dropdown-menu" aria-labelledby="">
                        </div>
                    </div>

                </form>

                <div class="selectedProduct">
                    <h2>Các sản phẩm bạn đã chọn cho đơn hàng</h2>
                    <ul>
                        <li></li>
                    </ul>
                </div>

            </div>

        </div>

    </div>

<script>

    $(document).ready(function() {

        var productsOrdered = [];

        console.log(productsOrdered);

        $("#look_for_product").keyup(function(event) {
            var getInput = $(this).val();

                $.ajax({
                    url: "{{ url('search-product') }}",
                    method: "GET",
                    data: { input: getInput, },
                    success: function(res) {
                        $("#findProductList").addClass("show");
                        $("#findProductList").html(res);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

        });

        $(document).on("click", ".dropdown-item" , function(event){
            event.preventDefault();
            var currentDataID = $(this).data("id");
            console.log(currentDataID);

            $.ajax({
                url: "{{ url('get-selected-product') }}",
                method: "GET",
                dataType: "json",
                data: { currentID : currentDataID },
                success: function(res) {
                    productsOrdered.push(res);
                    console.log(productsOrdered);
                    var valueArr = productsOrdered.map(function(item){ return item.id });
                    var isDuplicate = valueArr.some(function(item, index){ 
                        return valueArr.indexOf(item) != index 
                    });

                    if ( isDuplicate == true ) {
                        productsOrdered.pop();
                        console.log(productsOrdered);

                    } else {
                        console.log('everything is fine');

                        var i;
                        for ( i = 0; i < productsOrdered.length; i++ ) {
                            console.log(productsOrdered[i]);
                        }

                        // productsOrdered.forEach(function(item, index) {
                        //     console.log(item["id"]);
                        //     $(".selectedProduct ul").append(item["name"] + "<br>");
                        // });

                    }

                },
                error: function(err) {
                    console.log(err);
                }
            });


        });



        



    });


</script>

@endsection
