$(document).ready(function() {


    /**
    * HELPER FUNCTIONS
    */

        var productsOrdered = [];
        var pio = [];
        
        // Convert Object to JSON
        function objToJson(formArray) { 
            var returnArray = {};
            for (var i = 0, len = formArray.length; i < len; i++)
                returnArray[formArray[i].name] = formArray[i].value;
            return returnArray;
        }

        function getUnique(array){
            var uniqueArray = [];
            
            // Loop through array values
            for(i=0; i < array.length; i++){
                if(uniqueArray.indexOf(array[i]) === -1) {
                    uniqueArray.push(array[i]);
                }
            }
            return uniqueArray;
        }

        console.log(productsOrdered.length);

        // AJAX - Find product by name, check what user types in
        function findProductByName(event) {
        	var getInput = $(this).val();

            $.ajax({
                url: "/search-product",
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
        } 

        // AJAX - Get product that user select 
    
        $("#look_for_product").keyup(findProductByName);

        $(document).on("click", ".dropdown-item" , function(event){
            event.preventDefault();
            var currentDataID = $(this).data("id");
            console.log(currentDataID);

            $.ajax({
                url: "/get-selected-product",
                method: "GET",
                dataType: "json",
                data: { currentID : currentDataID },
                success: function(res) {
                	$("#findProductList").removeClass("show");
                    productsOrdered.push(res);
                    var x, text = "";
                    // $("#whereToPrint").html(productsOrdered);
                    
                    // console.log(productsOrdered);
                    var valueArr = productsOrdered.map(function(item){ return item.id });
                    var isDuplicate = valueArr.some(function(item, index){ 
                        return valueArr.indexOf(item) != index 
                    });

                    if ( isDuplicate == true ) {
                        productsOrdered.pop();
                        console.log(productsOrdered);

                    } else {
                        console.log('everything is fine');
                    }

                    for (x in productsOrdered) {
                        // text += productsOrdered[x].name + "<br>";

                        text += "<tr class='tt'>" + 
                                "<td>" + "<img src='http://laravel-storage/uploaded/" + productsOrdered[x].img +"'" + "/>" + "</td>" +
                                "<td>" + productsOrdered[x].name + "</td>"  + 
                                "<td>" + productsOrdered[x].sku + "</td>"  +
                                "<td>" + "<input type='number' name='" + productsOrdered[x].id + "'>" + "</td>" + 
                                "<td>" + "<a href='' data-id='" + productsOrdered[x].id + "' class='triggerExp'>Tạo HSD</a>" +
                                "<tr>";
                        pio.push(productsOrdered[x].id);
                    };
                    document.querySelector(".LT_body").innerHTML = text;
                    // $(".LT_body").append(text);


                },
                error: function(err) {
                    console.log(err);
                }
            });


        });

        $(document).on('click', ".triggerExp", function(event) {
            event.preventDefault();
            console.log($(this).data('id'));
            $("#exp_tb_body").append("<p>Append here</p>");
        });

        $("#createOrderSubmit").click(function(event) {
            var formData = $('#formTwo').serializeArray(),
            rs = objToJson(formData);

            var uniquePiO = getUnique(pio);
            var location = $("#storage_location").val();
            var orderCode = $("#order_code").val();
            var deadline = $("input[name='deadline']").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/orders/create-import",
                method: "post",
                dataType: "json",
                data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline },
                success: function(res) {
                    window.location=res.url;               
                },
                error: function(res) {
                    console.log(res);                    
                }
            });

            // $('#rs').html(JSON.stringify(rs, undefined, 2));

        });



      $(".upload_img").on("change", function() {
        console.log($(".upload_img").val());
         $(".img_preview").removeAttr("style");
         $(".img_preview").attr("src", URL.createObjectURL(this.files[0]));
      });


        // Trigger event
        $("#exportable_products").keyup(findExportableProducts);

      // Load products in storage based on storage location 
        function findExportableProducts(event) {
            var getInput = $(this).val();
            var location = $("#location_id").val();

            $.ajax({
                url: "/load-exportable-product",
                method: "GET",
                data: { input: getInput, location: location},
                success: function(res) {
                    console.log(res);
                    $("#findProductList").addClass("show");
                    $("#findProductList").html(res);
                },
                error: function(err) {
                    console.log(err);   
                }
            });
        }


        $("#createExportOrder").click(function(event) {
            event.preventDefault();
            var formData = $('#exportForm').serializeArray(),
            rs = objToJson(formData);

            var uniquePiO = getUnique(pio);
            var location = $("#location_id").val();
            var orderCode = $("#order_code").val();
            var deadline = $("input[name='deadline']").val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/orders/create-export",
                method: "post",
                dataType: "json",
                data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline },
                success: function(res) {
                    window.location=res.url;
                    console.log(res);               
                },
                error: function(res) {
                    console.log(res);                    
                }
            });

        }); 

        // Create expiration dates
        $("#addExpDate").click(function(e) {
            e.preventDefault();
            $("#expirationDates").append(
                "<tr>" + 
                "<td>Phiên bản</td>" +
                "<td>Số lượng: <input type='number' class='form-control' name='expAmount' /></td>" +
                "<td>Ngày hết hạn: <input type='date' class='form-control' name='expDate' /></td>" +
                "<td></td>" +
                "<td></td>"
                + "</tr>"
            )
        });

        // Submit expiration form 
        var amountDate = {};
        var formOBJ = {};
        $("#submitExpi").click(function(e) {
            var formData = $("#expirationForm").serializeArray();
            var formValues = new FormData($('#expirationForm')[0]);
            var pid = $("#getPID").val();

            var allAmount = formValues.getAll('expAmount');
            var allDate = formValues.getAll('expDate');
            var location = $("#getLocation").val();

            allAmount.forEach((key, i) => amountDate[key] = allDate[i]);

            console.log(amountDate);

            // Display the key/value pairs
            for(var pair of formValues.entries()) {
                console.log(pair[0]+ ', '+ pair[1]); 
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/expiration/submit',
                method: "post",
                dataType: "json",
                data: { formData: formData, pid: pid, amountDate: amountDate, location: location },
                success: function(res) {
                    console.log(res);
                    window.location=res.url;
                },
                error: function(err) {
                    console.log(err);
                }
            })
        });


})