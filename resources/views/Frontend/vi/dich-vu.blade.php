@extends('Frontend.layout')
@section('title', 'Giới thiệu - Dịch vụ')
@section('css')
  <style type="text/css" media="screen">
    ul {
      list-style-type: square;
    }
  </style>
@endsection
@section('body')
@include('Frontend.widget_banner')
<section class="testimonial-outer padding-lg">
  <div class="container">
    <h3>Dịch vụ</h3>
    <hr />
    <p>Các hoạt động dịch vụ của Trung tâm</p>
    <ul>
        <li>Tập huấn kỹ năng xử lý và phân tích dữ liệu bằng phần mềm SPSS</li>
        <li>Điều tra, khảo sát theo yêu cầu</li>
        <li>Tạo form nhập và xử lý dự liệu</li>
        <li>Phân tích dữ liệu và viết báo cáo</li>
        <li>Nghiên cứu thị trường</li>
        <li>Tư vấn, dự báo xã hội</li>
        <li>Tư vấn Nghiên cứu Khoa học cho Sinh viên</li>
        <li>Tư vấn đào tạo</li>
        <li>Tư vấn chính sách</li>
        <li>Đánh giá dự án</li>
        <li>Chủ trì hoặc phối hợp thực hiện đề tài nghiên cứu khoa học các cấp</li>
        <li>Tổ chức hội nghị, hội thảo nghiên cứu khoa học</li>
        <li>Xây dựng đề án tự chủ cho các đơn vị sự nghiệp công lập</li>
    </ul>
</section>

@endsection
@section('js')
<script type="text/javascript" src="{{ env('APP_URL') }}assets/frontend/libs/masonry/js/masonry.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
  $("#owl-demo").owlCarousel({
      autoPlay: 3000,
      items : 1,
      center:true,
      loop: true
  });
});
</script>
@endsection
