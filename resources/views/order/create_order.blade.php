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
                <form action="">
                    <input type="text" name="findProducts" value="">
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

@endsection
