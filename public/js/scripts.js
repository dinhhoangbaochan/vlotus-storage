$(document).ready(function() {


        var productsOrdered = [];

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
                    console.log(typeof productsOrdered);
                    var x, text = "";
                    for (x in productsOrdered) {
						text += productsOrdered[x].name + "<br>";
					};
                    document.getElementById("whereToPrint").innerHTML = text;
                    // $("#whereToPrint").html(productsOrdered);
                    
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

                        


                    }

                },
                error: function(err) {
                    console.log(err);
                }
            });


        });



      $(".upload_img").on("change", function() {
        console.log($(".upload_img").val());
         $(".img_preview").removeAttr("style");
         $(".img_preview").attr("src", URL.createObjectURL(this.files[0]));
      });


})