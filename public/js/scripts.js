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

        $(document).on("click", ".import-dropdown" , function(event){
            event.preventDefault();
            var currentDataID = $(this).data("id");

            

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
                                    "<td>" + productsOrdered[x].name + "</td>"  + 
                                    "<td>" + productsOrdered[x].sku + "</td>"  +
                                    "<td>" + "<input type='number' name='"+ productsOrdered[x].id +"' class='form-control' readonly>" + "</td>" + 
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

                                                "<div class='row mb-2'>" + 
                                                    "<div class='col-5'><input type='number' class='form-control' /></div>" +
                                                    "<div class='col-5'><input type='text' class='imp_date form-control ' /></div>" +
                                                    "<div class='col-2 d-flex justify-content-center align-items-center'>" +
                                                        "<a class='triggerExp'><span class='material-icons'>add_task</span></a>" +
                                                        "<a class='deleteExp'><span class='material-icons'>close</span></a>"+
                                                    "</div>" +
                                                "</div>" +

                                            "</div>" +

                                            "<div class='modal-footer'>" +
                                                "<button id='cf_"+ productsOrdered[x].id +"'>Tạo hạn sử dụng</button>" +
                                            "</div>" +

                                        "</div>" +
                                    "</div>" +
                                "</div>" 
                                ;
                        pio.push(productsOrdered[x].id);


                        $(document).on("click", "#cf_" + productsOrdered[x].id ,function(e) {
                            e.preventDefault();
                            var thisParentId = $(this).parent().parent().parent().parent().attr('id');
                            var thisParentData = $(this).parent().parent().parent().parent().data('sku');

                            var inputAmountValues = $('#'+ thisParentId  + ' input[type="number"]').map(function() {
                                return +$(this).val() // return value and convert value into integer
                            }).get();
                            
                            var inputDateValues = $('#'+ thisParentId + ' input[type="date"]').map(function() {
                                return $(this).val()
                            }).get();

                            var sumOfAmount = inputAmountValues.reduce(function(a,b){ return a + b })

                            mergeArray[thisParentData] = [];

                            inputAmountValues.forEach(function(key, i) {
                                // mergeArray[thisParentData][key] = inputDateValues[i]
                                mergeArray[thisParentData].push({
                                    [key]: inputDateValues[i]
                                })
                            });

                            console.log(sumOfAmount);
                            $(" input[name='"+ thisParentData + "'] ").val(sumOfAmount);

                            $("#op_" + thisParentData).modal('hide');
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
        
        $(document).on('focus', '.imp_date', function() {
            $(this).flatpickr({
                enableTime: true,
            });
        });


        $("#createOrderSubmit").click(function(event) {
            
            var formProducts = $('#formTwo').serializeArray(),
            rs = objToJson(formProducts);

            var uniquePiO = getUnique(pio);
            var location = $("#storage_location").val();
            // var orderCode = $("#order_code").val();
            var orderCode;
            var deadline = $("input[name='deadline']").val();
            var expirationList = mergeArray;

            var today = new Date();
            var locationCode;
            var date = "" + today.getFullYear() + (today.getMonth()+1) + today.getDate();
            var time = "" + today.getHours() + today.getMinutes() + today.getSeconds();
            var dateTime = date + time;

            if ( location == 1 ) {
                locationCode = 'NTL';
            } else {
                locationCode = 'TT';
            }

            orderCode = locationCode + dateTime;
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/orders/create-import",
                method: "post",
                dataType: "json",
                data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline, expirationList: expirationList },
                success: function(res) {
                    window.location=res.url;    
                    // console.log(res);           
                },
                error: function(res) {
                    console.log(res);                    
                }
            });

            $('#rs').html(JSON.stringify(rs, undefined, 2));

        });


        $(document).on('click', ".triggerExp", function(event) {
            event.preventDefault();
            var elementParent = $(this).parent().parent();
            console.log(elementParent.clone());
            var copy = "<div class='row mb-2'>" + 
                        "<div class='col-5'><input type='number' class='form-control' /></div>" +
                        "<div class='col-5'><input type='text' class='imp_date form-control ' /></div>" +
                        "<div class='col-2 d-flex justify-content-center align-items-center'>" +
                            "<a class='triggerExp'><span class='material-icons'>add_task</span></a>" +
                            "<a class='deleteExp'><span class='material-icons'>close</span></a>"+
                        "</div>" +
                    "</div>";
            $(copy).insertAfter(elementParent);



            
        });


        $(document).on('click', ".deleteExp", function(event) {
            event.preventDefault();
            $(this).closest('.row').remove();
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

        $(document).on("click", ".export-dropdown" , function(event){
            event.preventDefault();
            var currentDataID = $(this).data("id");
            console.log(currentDataID);

            $.ajax({
                url: "/choose-export-product",
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
                                    "<td>" + productsOrdered[x].name + "</td>"  + 
                                    "<td>" + productsOrdered[x].sku + "</td>"  +
                                    "<td>" + "<input type='number' name='"+ productsOrdered[x].id +"' class='form-control' readonly>" + "</td>" + 
                                    "<td><a data-toggle='modal' class='expand_collapse' href='#coll_"+ productsOrdered[x].id +"' data-id='"+ productsOrdered[x].id +"'>+</a></td>" +
                                "<tr>" +


                                "<div class='modal' id='coll_" + productsOrdered[x].id + "'>" +
                                    "<div class='modal-dialog'>" +
                                    "<div class='modal-content'>" +
                                        "<div class='modal-header'>" + 
                                            "<h3>Chọn phiên bản xuất</h3>" + 
                                        "</div>" +

                                        "<div class='modal-body'>" + 
                                            "<span>hey</span>" +
                                        "</div>" +

                                        "<div class='modal-footer'>" +
                                            "<button class='cf_exp'>Confirm</button>"
                                        "</div>" +
                                    "</div>" +
                                    "</div>" +
                                "</div>" 
                                ;
                        pio.push(productsOrdered[x].id);

                        $(document).on("click", "#cf_" + productsOrdered[x].id ,function(e) {
                            e.preventDefault();
                            var thisParentId = $(this).parent().parent().parent().parent().attr('id');
                            var thisParentData = $(this).parent().parent().parent().parent().data('sku');

                            var inputAmountValues = $('#'+ thisParentId  + ' input[type="number"]').map(function() {
                                return +$(this).val() // return value and convert value into integer
                            }).get();
                            
                            var inputDateValues = $('#'+ thisParentId + ' input[type="date"]').map(function() {
                                return $(this).val()
                            }).get();

                            var sumOfAmount = inputAmountValues.reduce(function(a,b){ return a + b })

                            mergeArray[thisParentData] = [];

                            inputAmountValues.forEach(function(key, i) {
                                // mergeArray[thisParentData][key] = inputDateValues[i]
                                mergeArray[thisParentData].push({
                                    [key]: inputDateValues[i]
                                })
                            });

                            console.log(sumOfAmount);
                            $(" input[name='"+ thisParentData + "'] ").val(sumOfAmount);

                            $("#op_" + thisParentData).modal('hide');
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



        $(document).on("click", ".expand_collapse", function(e) {
            
            var id = $(this).data('id');
            var location = $('#location_id').val();
            var obj = "";

            $.ajax({
                url: "/load-expiration",
                method: "GET",
                dataType: "json",
                data: { id: id, location: location },
                success: function(res) {
                    console.log(res);
                    res.forEach(function(item) {
                        Object.entries(item).forEach(([amount, date]) => {
                            obj += "<div class='row mb-3'>" +
                                        "<div class='col-4'>" +
                                            "<input type='number' name='newExp' class='form-control' />" +
                                        "</div>" +
                                        "<div class='col-4'>" +
                                            "<input type='number' value='"+ amount +"' class='form-control' readonly>" +
                                        "</div>" +
                                        "<div class='col-4'>" +
                                            "<input type='text' value='"+date+"' name='newDate' class='form-control' readonly />" +
                                        "</div>" + 
                                    "</div>"
                            ;
                        })
                    });
      
                    document.querySelector("#coll_" + id + ' .modal-body').innerHTML = obj;          
                },
                error: function(err) {
                    console.log(err);
                }
            });

        });


        // Image preview when uploaded
        $(".upload_img").on("change", function() {
            $(".img_preview").removeAttr("style");
            $(".img_preview").attr("src", URL.createObjectURL(this.files[0]));
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