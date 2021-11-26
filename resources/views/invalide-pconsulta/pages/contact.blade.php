@extends('site.layout.layout')
@section('content')
  @include('site.components.banner')
  <!--Contact us-->
  <section class="section section-xl bg-default">
    <div class="container">
      <div class="row row-30 row-md-50">
        <div class="col-lg-4 col-xl-5">
          @include('site.components.info')
        </div>
        <div class="col-lg-8 col-xl-7">
          <!--RD Mailform-->
          @include('site.components.form_contact')
        </div>
      </div>
    </div>
  </section>
  @include('site.components.map')
@endsection
