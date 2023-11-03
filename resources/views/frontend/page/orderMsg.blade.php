
@extends('frontend.master')

@section('mainbody')

<!-- BREADCRUMB -->
<div id="breadcrumb" class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <h3 class="breadcrumb-header">Checkout</h3>
                <ul class="breadcrumb-tree">
                    <li><a href="{{route('frontend_site')}}">Home</a></li>
                    <li class="">Shipping Details</li>
                    <li class="active">Payment </li>
                </ul>
            </div>
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /BREADCRUMB -->
<div class="section">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6">
                <div class="alert alert-success" role="alert" style="">
                    <h3 class="alert-heading" style="text-align: center;">Well Done!</h3>
                    <h4 style="text-align: center;">You have successfully placed order</h4>

                    <hr>
                    <p class="mb-0" style="text-align: center;">We will contact you soon.</p>
                </div>
                </div>
                <div class="col-md-3"></div>
        </div>
    </div>
</div>

@endsection
<script type="text/javascript">
    // Hide the template after a few seconds
    setTimeout(function () {

        window.location.href = '/'; 
    }, 5000); 
</script>