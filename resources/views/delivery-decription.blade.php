@extends('layouts.app')

@section('content')

<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="blog">
    <div class="container h-100">
        <div class="blog-banner">
            <div class="text-center">
                <h1>Delivery Description</h1>
                <nav aria-label="breadcrumb" class="banner-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Delivery Description</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<section class="blog_area single-post-area  section-margin--small">
    <div class="container">
        <div class="row">
            <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th scope="col">Monday</th>
                        <th scope="col">Tuesday</th>
                        <th scope="col">Wednesday</th>
                        <th scope="col">Thursday</th>
                        <th scope="col">Friday</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <ul>
                                <li>Scarborough</li>
                                <li>Markham</li>
                                <li>Stouffville</li>
                                <li>Aurora</li>
                                <li>Newmarket</li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li>pickering</li>
                                <li>Ajax</li>
                                <li>Whitby</li>
                                <li>Oshawa</li>
                                <li>Bowmanville</li>
                                <li>Peterborough</li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li>Eglinton West, York.</li>
                                <li>Downtown Toronto</li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li>pickering</li>
                                <li>Ajax</li>
                                <li>Whitby</li>
                                <li>Oshawa</li>
                                <li>Bowmanville</li>
                                <li>Peterborough</li>
                            </ul>
                        </td>
                        <td>
                            <ul>
                                <li>Eglinton West, York</li>
                                <li>Downtown Toronto</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>Delivery for a minimum order of $200.00
                            ($250.00 up delivery free)
                        </td>

                        <td>Delivery for a minimum order of $250.00
                            ($280.00 up delivery free.)
                        </td>
                        <td>Delivery for a minimum order of $280.00
                            ($300.00 up delivery free)
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <h4>Note:</h4>
            <p>Business days <b> Monday to Friday</b></p>
            <p>Order your products before <b> 2 Days</b></p>
            <p><b> Emergency Ordering</b> can be sent with a courier company for an additional cost </p>
        </div>
    </div>
</section>
<!-- ================ end banner area ================= -->

@endsection