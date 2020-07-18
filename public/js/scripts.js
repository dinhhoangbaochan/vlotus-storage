$(document).ready(function() {


        var productsOrdered = [];

        console.log(productsOrdered.length);

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
                            console.log("heeee");
                        }


                    }

                },
                error: function(err) {
                    console.log(err);
                }
            });


        });



        



})