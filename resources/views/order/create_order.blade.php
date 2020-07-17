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
                    <input type="text" id="look_for_product" name="findProducts" value="" >
                    <div class="results">
                        <ul>
                            <li>Result 1</li>
                            <li>Result 2</li>
                            <li>Result 3</li>
                        </ul>
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
                        console.log(res);
                        $(".results").html(res);
                    },
                    error: function(err) {
                        console.log(err);
                    }
                });

        });



    });


</script>

@endsection
