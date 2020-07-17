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
            </div>

        </div>

    </div>

<script>

    $(document).ready(function() {

        $("#look_for_product").keyup(function(event) {
            /* Act on the event */
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
            console.log($(this).data("id"));
        })

    });


</script>

@endsection
