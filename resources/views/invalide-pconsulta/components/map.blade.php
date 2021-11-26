  <!--Google Map-->
@php
  $payload = GigaGetData::footer();
@endphp
<section class="section">

  <!--Please, add the data attribute data-key="YOUR_API_KEY" in order to insert your own API key for the Google map.-->
  <!--Please note that YOUR_API_KEY should replaced with your key.-->
  <!--Example: <div class="google-map-container" data-key="YOUR_API_KEY">-->
  <div class="google-map-container" data-center="9870 St Vincent Place, Glasgow, DC 45 Fr 45." data-zoom="5" data-icon="images/gmap_marker.png" data-icon-active="images/gmap_marker_active.png">
    {!! $payload->map_iframe !!}
  </div>
</section>
