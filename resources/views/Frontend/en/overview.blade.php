@extends('Frontend.layout')
@section('title', 'Introduction - Overview')
@section('css')
  <style type="text/css" media="screen">
    .noi-dung h3 {
      padding: 5px;
      text-align: center;
      color: #4472c4;
    }
    .noi-dung ul {
      margin-top: 0px;
      margin-bottom: 10px;
    }
  </style>
@endsection
@section('body')
<section class="about inner padding-lg">
  <div class="container noi-dung">
    {!! $noi_dung !!}
    {{--
    <div class="row">
      <div class="col-md-12" style="text-align:justify;">
        <p> Social Sciences and Humannities Research Center was established under the Decision 671/QD.UB dated 7th May 2003 by The People's Committe of An Giang Province.</p>
        <ul style="padding-bottom:10px;">
            <li>Office: 18, Ung Van Khiem street, Dong Xuyen ward, Long Xuyen city, An Giang, Vietnam</li>
            <li>Phone number: (+84) (296) 3943695</li>
            <li>E-mail: shrc@agu.edu.vn</li>
            <li>Website: shrc.agu.edu.vn</li>
        </ul>
        <p class="text-center">
            <a class="galleryItem" href="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg">
          <img src="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg" alt="Trung tâm Nghiên cứu Xã hội và Nhân văn" style="margin: 0px 20px 0px 0px; "></a>
        </p>
        <p>The Center's research staff are young and active. They participate in researches and projects on social sciences and humannities, such as: education, culture, community development, social work, history, etc.</p>
      </div>
    </div> --}}
  </div>
</section>
@endsection
