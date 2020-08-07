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

        var fData = new FormData($('#formTwo')[0]);
        var mergeArray = {};

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

                    var valueArr = productsOrdered.map(function(item){ return item.id });
                    var isDuplicate = valueArr.some(function(item, index){ 
                        return valueArr.indexOf(item) != index 
                    });

                    if ( isDuplicate == true ) {
                        productsOrdered.pop();
                        // console.log(productsOrdered);

                    } 
                    for (x in productsOrdered) {
                        // text += productsOrdered[x].name + "<br>";

                        text += "<tr class='tt' data-id='"+ productsOrdered[x].id +"'>" + 
                                    "<td>" + "<img src='http://laravel-storage/uploaded/" + productsOrdered[x].img +"'" + "/>" + "</td>" +
                                    "<td>" + productsOrdered[x].name + "<input type='hidden' name='productID' value='"+ productsOrdered[x].id +"' />" + "</td>"  + 
                                    "<td>" + productsOrdered[x].sku + "</td>"  +
                                    "<td>" + "<input type='number' name='pickAmount'>" + "</td>" + 
                                    "<td>" + "<input type='date' name='pickADate' />" +
                                    "<td><a href data-target='#op_"+ productsOrdered[x].id +"' data-toggle='modal'>+</a></td>" +
                                "<tr>" +

                                "<div class='modal fade' id='op_"+ productsOrdered[x].id +"' data-sku='"+ productsOrdered[x].id +"' role='dialog' aria-hidden='true'>" +
                                    "<div class='modal-dialog expiration-modal' role='document'>" +
                                        "<div class='modal-content'>" +

                                            "<div class='modal-header'>" +
                                                "<h5 class='modal-title'>Quản lý hạn sử dụng</h5>" +
                                                "<button class='close' data-dismiss='modal'><span>&times;</span></button>" +
                                            "</div>" +

                                            "<div class='modal-body'>" +
                                                "<span>This is product: " + productsOrdered[x].name + "</span>" +

                                                "<div class='row'>" + 
                                                    "<div class='col-5'><input type='number' class='form-control' name='Amount_' /></div>" +
                                                    "<div class='col-5'><input type='date' class='form-control' name='Date_"+ productsOrdered[x].id +"' /></div>" +
                                                    "<div class='col-2'><a class='triggerExp'>++</a></div>" +
                                                "</div>" +

                                            "</div>" +

                                            "<div class='modal-footer'>" +
                                                "<button id='cf_"+ productsOrdered[x].id +"'>Trigger</button>" +
                                            "</div>" +

                                        "</div>" +
                                    "</div>" +
                                "</div>" 
                                ;
                        pio.push(productsOrdered[x].id);

                        // var newScript = document.createElement("script");
                        // var inlineScript = document.createTextNode("alert('Hello World!' + productsOrdered[x].id);");
                        // newScript.appendChild(inlineScript); 
                        // document.querySelector(".LT_body").appendChild(newScript);

                        var currentAmounts = fData.getAll('Amount_');

                        $(document).on("click", "#cf_" + productsOrdered[x].id ,function(e) {
                            e.preventDefault();
                            var thisParentId = $(this).parent().parent().parent().parent().attr('id');
                            var thisParentData = $(this).parent().parent().parent().parent().data('sku');
                            console.log('trigger event at ID ' + thisParentId);

                            var inputAmountValues = $('#'+ thisParentId  + ' input[type="number"]').map(function() {
                                return $(this).val()
                            }).get();
                            
                            var inputDateValues = $('#'+ thisParentId + ' input[type="date"]').map(function() {
                                return $(this).val()
                            }).get();

                            console.log(inputAmountValues);
                            console.log(inputDateValues);
                            mergeArray[thisParentData] = {};

                            inputAmountValues.forEach((key, i) => mergeArray[thisParentData][key] = inputDateValues[i]);
                            console.log(mergeArray);
                        });


                    };
                    
                    document.querySelector(".LT_body").innerHTML = text;
                    // $(".LT_body").append(text);


                },
                error: function(err) {
                    console.log(err);
                }
            });


        });

        
        var object = {};
        var json = JSON.stringify(object);
        $("#createOrderSubmit").click(function(event) {
            
            var formProducts = $('#formTwo');
            var formData = new FormData(formProducts[0]);
            // rs = objToJson(formData);

            var uniquePiO = getUnique(pio);
            var location = $("#storage_location").val();
            var orderCode = $("#order_code").val();
            var deadline = $("input[name='deadline']").val();

            formData.forEach(function(value, key){
                // console.log('key ' + key + ' - ' + 'value ' + value);
                console.log(formData);
            });
            
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     url: "/orders/create-import",
            //     method: "post",
            //     dataType: "json",
            //     data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline },
            //     success: function(res) {
            //         window.location=res.url;               
            //     },
            //     error: function(res) {
            //         console.log(res);                    
            //     }
            // });

            // $('#rs').html(JSON.stringify(rs, undefined, 2));

        });


        $(document).on('click', ".triggerExp", function(event) {
            event.preventDefault();
            var elementParent = $(this).parent().parent();
            console.log(elementParent.clone());
            elementParent.clone().insertAfter(elementParent);
            
        });


        // Image preview when uploaded
        $(".upload_img").on("change", function() {
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