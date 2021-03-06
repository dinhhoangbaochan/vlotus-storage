$(document).ready(function() {


        var config = {
            enableTime: true,
            // minDate: "today"
        };

        const parentURL = document.location.origin;

        var productsOrdered = [];
        var pio = [];
        var formExport = new FormData( $('#exportForm')[0] );

        $(document).on('focus', '.imp_date', function() {
            $(this).flatpickr(config);
        });

        $(".deadline_date").flatpickr(config);

        $(".search-input").attr('autocomplete', "off");
        
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
                url: parentURL + "/search-product",
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
                url: parentURL + "/get-selected-product",
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
                                    "<td>" + "<img src='"+ parentURL +"/uploaded/" + productsOrdered[x].img +"'" + "/>" + "</td>" +
                                    "<td>" + productsOrdered[x].name + "</td>"  + 
                                    "<td>" + productsOrdered[x].sku + "</td>"  +
                                    "<td>" + "<input type='number' name='"+ productsOrdered[x].id +"' class='form-control t_qty' readonly>" + "</td>" + 
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

                                                    "<div class='col-5'>" + 
                                                        "<h3 class='guide_label'>Nhập số lượng cần nhập</h3>" +
                                                    "</div>" +

                                                    "<div class='col-5'>" + 
                                                        "<h3 class='guide_label'>Tạo hạn sử dụng</h3>" +
                                                    "</div>" +

                                                    "<div class='col-2'>" + 
                                                        "<h3 class='guide_label'>Thao tác</h3>" +
                                                    "</div>" +
                                                "</div>" +

                                                "<div class='row mb-2'>" + 

                                                    "<div class='col-5'>" + 
                                                        "<div class='input-group'>" + 

                                                            "<div class='input-group-prepend'>" +
                                                                "<span class='input-group-text material-icons'>import_export</span>" + 
                                                            "</div>" +

                                                            "<input type='number' class='form-control' />" + 
                                                        "</div>" +
                                                        
                                                    "</div>" +

                                                    "<div class='col-5'>" + 
                                                        "<div class='input-group'>" + 

                                                            "<div class='input-group-prepend'>" +
                                                                "<span class='input-group-text material-icons'>calendar_today</span>" + 
                                                            "</div>" +

                                                            "<input type='text' class='imp_date '/>" + 
                                                        "</div>" +
                                                        
                                                    "</div>" +

                                                    "<div class='col-2 d-flex align-items-center'>" +
                                                        "<a class='triggerExp'><span class='material-icons'>add</span></a>" +
                                                        // "<a class='deleteExp'><span class='material-icons'>close</span></a>"+
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
                            
                            var inputDateValues = $('#'+ thisParentId + ' .imp_date').map(function() {
                                return $(this).val()
                            }).get();

                            var sumOfAmount = inputAmountValues.reduce(function(a,b){ return a + b })

                            mergeArray[thisParentData] = [];

                            var resultObject = {};
                            inputDateValues.forEach((key, i) => resultObject[key] = inputAmountValues[i]);
                            

                            mergeArray[thisParentData].push(resultObject);

                            $(" input[name='"+ thisParentData + "'] ").val(sumOfAmount);

                            var emptyAmount = inputAmountValues.includes(0);
                            var emptyDate = inputDateValues.includes("");

                            if ( emptyAmount ) {
                                alert('Vui lòng điền đủ các trường số lượng');
                            } 

                            if ( emptyDate ) {
                                alert('Vui lòng điền đủ các trường hạn sử dụng');
                            } 
                            if ( !emptyAmount && !emptyDate ) {
                                $("#op_" + thisParentData).modal('hide');
                            }

                            // $("#op_" + thisParentData).modal('hide');
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


        $("#createOrderSubmit").click(function(event) {
            
            var formProducts = $('#formTwo').serializeArray(),
            rs = objToJson(formProducts);

            var uniquePiO = getUnique(pio);
            var location = $("#storage_location").val();
            // var orderCode = $("#order_code").val();
            var orderCode;
            var deadline = $(".deadline_date").val();
            var expirationList = mergeArray;

            var today = new Date();
            var locationCode;
            var date = "" + today.getFullYear() + (today.getMonth()+1) + today.getDate();
            var time = "" + today.getHours() + today.getMinutes() + today.getSeconds();
            var dateTime = date + time;

            var listQTY = $('.t_qty').map(function() {
                return $(this).val()
            }).get();

            if ( location == 1 ) {
                locationCode = 'NTL';
            } else {
                locationCode = 'TT';
            }

            orderCode = locationCode + dateTime;
            var emptyQTY = listQTY.includes("");
            console.log(listQTY);

            if ( $.isEmptyObject(rs) ) {
                alert('Vui lòng chọn sản phẩm trước khi tạo đơn');
            } else if (emptyQTY) {
                alert('Vui lòng chọn số lượng - hạn sử dụng');
            } else if ( !deadline ) {
                alert('Vui lòng chọn ngày hẹn giao');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: parentURL + "/orders/create-import",
                    method: "post",
                    dataType: "json",
                    data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline, expirationList: expirationList },
                    success: function(res) {
                        alert("Đã tạo đơn thành công");
                        window.location=res.url;             
                    },
                    error: function(res) {
                        console.log(res);                    
                    }
                });

            }
            



        });


        $(document).on('click', ".triggerExp", function(event) {
            event.preventDefault();
            var elementParent = $(this).parent().parent();
            console.log(elementParent.clone());
            var copy = "<div class='row mb-2'>" + 

                            "<div class='col-5'>" + 
                                "<div class='input-group'>" + 

                                    "<div class='input-group-prepend'>" +
                                        "<span class='input-group-text material-icons'>import_export</span>" + 
                                    "</div>" +

                                    "<input type='number' class='form-control' />" + 
                                "</div>" +
                                
                            "</div>" +

                            "<div class='col-5'>" + 
                                "<div class='input-group'>" + 

                                    "<div class='input-group-prepend'>" +
                                        "<span class='input-group-text material-icons'>calendar_today</span>" + 
                                    "</div>" +

                                    "<input type='text' class='imp_date '/>" + 
                                "</div>" +
                                
                            "</div>" +

                            "<div class='col-2 d-flex align-items-center'>" +
                                "<a class='triggerExp'><span class='material-icons'>add</span></a>" +
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
                url: parentURL + "/load-exportable-product",
                method: "GET",
                data: { input: getInput, location: location},
                success: function(res) {
                    $("#findProductList").addClass("show");
                    $("#findProductList").html(res);
                },
                error: function(err) {
                    console.log(err);   
                }
            });
        }

        $(document).on("click", ".export-dropdown" , function(event){
            event.preventDefault();
            var currentDataID = $(this).data("id");
            console.log(currentDataID);

            $.ajax({
                url: parentURL + "/choose-export-product",
                method: "GET",
                dataType: "json",
                data: { currentID : currentDataID },
                success: function(res) {
                    $("#findProductList").removeClass("show");
                    productsOrdered.push(res);
                    var x, text, newLine = "";

                    var valueArr = productsOrdered.map(function(item){ return item.id });
                    var isDuplicate = valueArr.some(function(item, index){ 
                        return valueArr.indexOf(item) != index 
                    });

                    if ( isDuplicate == true ) {
                        productsOrdered.pop();
                    } 

                    for (x in productsOrdered) {
                        // text += productsOrdered[x].name + "<br>";

                        text += "<tr class='tt' data-id='"+ productsOrdered[x].id +"'>" + 
                                    "<td>" + "<img src='"+parentURL+"/uploaded/" + productsOrdered[x].img +"'" + "/>" + "</td>" +
                                    "<td>" + productsOrdered[x].name + "</td>"  + 
                                    "<td>" + productsOrdered[x].sku + "</td>"  +
                                    "<td>" + "<input type='number' name='"+ productsOrdered[x].id +"' class='form-control' readonly>" + "</td>" + 
                                    "<td><a data-toggle='modal' class='expand_collapse' href='#coll_"+ productsOrdered[x].id +"' data-id='"+ productsOrdered[x].id +"'>+</a></td>" +
                                "<tr>" +


                                "<div class='modal choose_version' id='coll_" + productsOrdered[x].id + "' data-id='"+ productsOrdered[x].id +"' >" +
                                    "<div class='modal-dialog'>" +
                                    "<div class='modal-content'>" +
                                        "<div class='modal-header'>" + 
                                            "<h3>Chọn phiên bản xuất</h3>" + 
                                        "</div>" +

                                        "<div class='modal-body'>" + 
                                            "<span></span>" +
                                        "</div>" +

                                        "<div class='modal-footer'>" +
                                            "<button class='cf_exp'>Xác Nhận</button>"
                                        "</div>" +
                                    "</div>" +
                                    "</div>" +
                                "</div>" 
                                ;
                        pio.push(productsOrdered[x].id);

                };

                newLine += "<tr class='tt' data-id='"+ res.id +"'>" + 
                                    "<td>" + "<img src='"+parentURL+"/uploaded/" + res.img +"'" + "/>" + "</td>" +
                                    "<td>" + res.name + "</td>"  + 
                                    "<td>" + res.sku + "</td>"  +
                                    "<td>" + "<input type='number' name='"+ res.id +"' class='form-control e_qty' readonly>" + "</td>" + 
                                    "<td>"+
                                        "<a data-toggle='modal' class='expand_collapse' href='#coll_"+ res.id +"' data-id='"+ res.id +"'>+</a>" +

                                "<div class='modal choose_version' id='coll_" + res.id + "' data-id='"+ res.id +"' >" +
                                    "<div class='modal-dialog'>" +
                                    "<div class='modal-content'>" +
                                        "<div class='modal-header'>" + 
                                            "<h3>Chọn phiên bản xuất</h3>" + 
                                        "</div>" +

                                        "<div class='modal-body'>" + 
                                                "<div class='row mb-2'>" + 

                                                    "<div class='col-5'>" + 
                                                        "<h3 class='guide_label'>Nhập số lượng cần xuất</h3>" +
                                                    "</div>" +

                                                    "<div class='col-5'>" + 
                                                        "<h3 class='guide_label'>Tạo hạn sử dụng</h3>" +
                                                    "</div>" +

                                                    "<div class='col-2'>" + 
                                                        "<h3 class='guide_label'>Thao tác</h3>" +
                                                    "</div>" +
                                                "</div>" +
                                            "<span></span>" +
                                        "</div>" +

                                        "<div class='modal-footer'>" +
                                            "<button class='cf_exp'>Xác Nhận</button>"
                                        "</div>" +
                                    "</div>" +
                                    "</div>" +
                                "</div>" +

                                    "</td>" +
                                    "<div class='modal'></div>" +
                                "</tr>" 

                                ;
                    
                    // document.querySelector(".LT_body").innerHTML = text;
                    $(".LT_body").append(newLine);


                },
                error: function(err) {
                    console.log(err);
                }
            });


        });



        $(document).on("click", ".expand_collapse", function(e) {
            
            var id = $(this).data('id');
            var location = $('#location_id').val();
            var obj = "<div class='row mb-2'>" + 

                        "<div class='col-4'>" + 
                            "<h3 class='guide_label'>Nhập số lượng cần xuất</h3>" +
                        "</div>" +

                        "<div class='col-4'>" + 
                            "<h3 class='guide_label'>Số lượng tồn kho</h3>" +
                        "</div>" +

                        "<div class='col-4'>" + 
                            "<h3 class='guide_label'>Ngày hết hạn</h3>" +
                        "</div>" +
                    "</div>";

            if ( id in mergeArray ) {
                $("#coll_" + id).modal('show');
            } else {
                $.ajax({
                    url: parentURL + "/load-expiration",
                    method: "GET",
                    dataType: "json",
                    data: { id: id, location: location },
                    success: function(res) {
                        console.log(res);
                        res.forEach(function(item) {
                            Object.entries(item).forEach(([date, amount]) => {
                                obj += "<div class='row mb-3'>" +
                                            "<div class='col-4'>" +

                                                "<div class='input-group'>" + 
                                                    "<div class='input-group-prepend'>" + 
                                                        '<span class="input-group-text material-icons">import_export</span>' +
                                                    "</div>" + 
                                                     "<input type='number' class='form-control ExpArr' min='0' max='"+ amount +"' placeholder='0'/>" +
                                                "</div>" +
                                            "</div>" +
                                            "<div class='col-4'>" +
                                                "<input type='number' value='"+ amount +"' class='form-control AmountArr' readonly>" +
                                            "</div>" +
                                            "<div class='col-4'>" +
                                                "<input type='text' value='"+date+"' class='form-control DateArr' readonly />" +
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

            }



        });

        $(document).on("keyup", ".ExpArr", function() {
            var value = $(this).val();
            var max = $(this).attr('max');
            var min =  $(this).attr('min');

            if ( value > parseInt(max, 10) ) {
                $(this).val(max)
            } else if ( value < parseInt(min, 10) ) {
                $(this).val(min);
            }

        });

        var currentExportArr = {};
        $(document).on("click", ".cf_exp", function(e) {
            e.preventDefault();

            var thisParentId = $(this).parent().parent().parent().parent().data('id');
            var expirationArray = $('#coll_'+ thisParentId  + ' .ExpArr').map(function() {
                return +$(this).val() // return value and convert value into integer
            }).get();
            var amountArray = $('#coll_'+ thisParentId  + ' .AmountArr').map(function() {
                return +$(this).val() // return value and convert value into integer
            }).get();
            var dateArray = $('#coll_'+ thisParentId  + ' .DateArr').map(function() {
                return $(this).val() // return value and convert value into integer
            }).get();

            var afterExportExp = [] // All values left after export

            for(let i = 0; i < expirationArray.length; i++) {
                afterExportExp.push(Math.abs(amountArray[i] - expirationArray[i]));
            }

            var testResults = {};
            dateArray.forEach((key, i) => testResults[key] = expirationArray[i]);
            currentExportArr[thisParentId] = [];
            currentExportArr[thisParentId].push(testResults);
            console.log(currentExportArr);

            var sumOfAmount = expirationArray.reduce(function(a,b){ return a + b })

            // afterExportExp.forEach(function(key, i) {
            //     // mergeArray[thisParentData][key] = inputDateValues[i]
            //     mergeArray[thisParentId].push({
            //         [key]: dateArray[i]
            //     })
            // });

            var resultObject = {};
            dateArray.forEach((key, i) => resultObject[key] = afterExportExp[i]);

            if ( sumOfAmount == 0 ) {
                alert('Vui lòng chọn phiên bản xuất');
            } else {
                mergeArray[thisParentId] = [];
                mergeArray[thisParentId].push(resultObject);
                $(" input[name='"+ thisParentId + "'] ").val(sumOfAmount);
                $("#coll_" + thisParentId).modal('hide');
            }
            
        });

        $("#createExportOrder").click(function(event) {
            event.preventDefault();
            var formData = $('#exportForm').serializeArray(),
            rs = objToJson(formData);

            var uniquePiO = getUnique(pio);
            var location = $("#location_id").val();
            var deadline = $(".deadline_date").val();
            var orderCode;
            var expirationList = mergeArray;

            var today = new Date();
            var locationCode;
            var date = "" + today.getFullYear() + (today.getMonth()+1) + today.getDate();
            var time = "" + today.getHours() + today.getMinutes() + today.getSeconds();
            var dateTime = date + time;

            var listQTY = $('.e_qty').map(function() {
                return $(this).val()
            }).get();

            if ( location == 1 ) {
                locationCode = 'NTL';
            } else {
                locationCode = 'TT';
            }

            orderCode = locationCode + dateTime;

            var emptyQTY = listQTY.includes("");

            if ( $.isEmptyObject(rs) ) {
                alert('Vui lòng chọn sản phẩm trước khi tạo đơn');
            } else if (emptyQTY) {
                alert('Vui lòng chọn số lượng cần xuất');
            } else if ( !deadline ) {
                alert('Vui lòng chọn ngày hẹn giao');
            } else {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: parentURL + "/orders/create-export",
                    method: "post",
                    dataType: "json",
                    data: {qty: rs, location: location, products: uniquePiO, orderCode: orderCode, deadline: deadline, expirationList: expirationList, currentExportArr: currentExportArr },
                    success: function(res) {
                        alert("Đã tạo đơn thành công");
                        window.location=res.url;
                        console.log(res);               
                    },
                    error: function(res) {
                        console.log(res);                    
                    }
                });
            }


        }); 



        // Image preview when uploaded
        $(".upload_img").on("change", function() {
            $(".img_preview").removeAttr("style");
            $(".img_preview").attr("src", URL.createObjectURL(this.files[0]));
        });


})