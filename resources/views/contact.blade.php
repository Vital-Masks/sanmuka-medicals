@extends('layouts.app')

@section('content')



<!-- ================ contact section start ================= -->
<section class="section-margin--small">
  <div class="container">

    <div class="row">

      <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="fa fa-globe"></i></span>
          <div class="media-body">
            <h3><a href="http://www.clickstores.ca/" target="_blank" style="color:black">www.sanmukamedicals.com</a></h3>
            <p>order through website</p>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="fa fa-phone"></i></span>
          <div class="media-body">
            <h3><a href="tel:+212243457">+(21) 224 3457</a></h3>
            <p>Mon to Sun 8.30 AM - 09.30 PM</p>
          </div>
        </div>
        <div class="media contact-info">
          <span class="contact-info__icon"><i class="fa fa-map-marker"></i></span>
          <div class="media-body">
            <h3><a href="mailto:info@clickstores.ca">No 54 K.K.S Road Chunnagam, Jaffna</a></h3>
            <p>Visit our store!</p>
          </div>
        </div>
      </div>
      <div class="col-md-8 col-lg-9">

      <div class="d-none d-sm-block mb-5 pb-4">
      <div id="map" style="height: 420px;"></div>
      <script>
        function initMap() {
          var uluru = {
            lat: -25.363,
            lng: 131.044
          };
          var grayStyles = [{
              featureType: "all",
              stylers: [{
                  saturation: -90
                },
                {
                  lightness: 50
                }
              ]
            },
            {
              elementType: 'labels.text.fill',
              stylers: [{
                color: '#A3A3A3'
              }]
            }
          ];
          var map = new google.maps.Map(document.getElementById('map'), {
            center: {
              lat: -31.197,
              lng: 150.744
            },
            zoom: 9,
            styles: grayStyles,
            scrollwheel: false
          });
        }
      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&callback=initMap"></script>

    </div>
      </div>
    </div>
  </div>
</section>
<!-- ================ contact section end ================= -->

@endsection