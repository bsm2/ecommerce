@extends('style.index')

@section('content')

<div class="maincontent-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product">
                    <h2 class="text-center">{!! settings()->message_maintenance !!}</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End main content area -->

    
@endsection