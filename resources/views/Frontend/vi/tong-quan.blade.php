@extends('Frontend.layout')
@section('title', 'Giới thiệu - Tổng quan')
@section('css')
  <style type="text/css" media="screen">
    .noi-dung h3 {
      padding: 5px;
      text-align: center;
      color: #4472c4;
    }
  </style>
@endsection
@section('body')
<div class="col-12">
  <div class="inner-banner contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12 col-md-12">
                <div class="content" style="width:100%; text-align:center">     
                    <h2 style="color: #058B3C;">KHOA NÔNG NGHIỆP - TÀI NGUYÊN THIÊN NHIÊN</h2>
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
<section class="about inner padding-lg">
  <div class="container noi-dung">
    {!! $noi_dung !!}
    {{-- <div class="row">
      <div class="col-md-12" style="text-align:justify;">
        <h3 class="title">Trung tâm Nghiên cứu Khoa học xã hội và Nhân văn</h3>
        <h3 style="color:#ff0000;" class="text-center">"Sáng tạo – Trách nhiệm – Hội nhập"</h3><br />
        <p> Trung tâm Nghiên cứu Khoa học xã hội và Nhân văn được thành lập theo Quyết định số 671/QĐ.UB ngày 07 tháng 05 năm 2003 của Uỷ ban nhân dân tỉnh An Giang.</p>
        <p>Trung tâm là một tổ chức nghiên cứu và phát triển cấp cơ sở, là đơn vị sự nghiệp trực thuộc Trường Đại học An Giang. Trung tâm có đầy đủ tư cách pháp nhân, có con dấu và tài khoản riêng tại Kho bạc nhà nước tỉnh An Giang.</p>
        <ul style="padding-bottom:10px;">
            <li>Trụ sở: số 18, đường Ung Văn Khiêm, phường Đông Xuyên, thành phố Long Xuyên, tỉnh An Giang (Lầu 2, Toà nhà Thư viện và các Trung tâm, khu trung tâm Trường Đại học An Giang)</li>
            <li>Điện thoại: 0296 3943695</li>
            <li>E-mail: shrc@agu.edu.vn</li>
            <li>Website: shrc.agu.edu.vn</li>
        </ul>
        <p>Trung tâm thực hiện các hoạt động nghiên cứu, ứng dụng và chuyển giao, đào tạo và huấn luyện và các dịch vụ khoa học và công nghệ lĩnh vực khoa học xã hội nhân văn nhằm đáp ứng yêu cầu phát triển nhà trường, phát triển kinh tế - xã hội tỉnh An Giang, các tỉnh Đồng bằng sông Cửu Long và nhu cầu xã hội. Trung tâm nỗ lực phấn đấu trở thành một trong những trung tâm nghiên cứu hàng đầu của tỉnh và khu vực.</p>
        <p class="text-center">
            <a class="galleryItem" href="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg">
          <img src="{{ env('APP_URL') }}assets/frontend/images/shrc.jpg" alt="Trung tâm Nghiên cứu Xã hội và Nhân văn" style="margin: 0px 20px 0px 0px; "></a>
        </p>
        <p>Trung tâm đã tổ chức thực hiện các hoạt động KHCN đáp ứng yêu cầu phát triển của các cơ quan, đơn vị, tổ chức trong và ngoài tỉnh như: các dự án xây dựng và triển khai các mô hình hỗ trợ cộng đồng (Tăng cường tiếng Việt cho trẻ em dân tộc Khmer trong phum sóc với sự hỗ trợ của sinh viên dân tộc Khmer; Nâng cao năng lực các dịch vụ tâm lý xã hội cho trẻ em mồ côi bị nhiễm HIV/AIDS và trẻ em bị ảnh hưởng bởi HIV/AIDS thông qua các dịch vụ trực tiếp và đào tạo công tác xã hội; Tăng cường hiểu biết về chính sách ưu đãi cho học sinh thiệt thòi nhằm đẩy lùi tham nhũng trong giáo dục...); các nghiên cứu cơ bản hỗ trợ các ngành, các cấp, các cơ quan, tổ chức xây dựng và triển khai các chính sách, chương trình, kế hoạch phát triển (thực trạng và giải pháp khắc phục tình trạng bỏ học của học sinh, thực trạng và giải pháp nâng cao chất lượng của đội ngũ giáo viên tiểu học; thực trạng và giải pháp tiếp cận giáo dục của người Chăm; nhu cầu giáo viên phổ thông và giáo viên dạy nghề; thực trạng và giải pháp thực hiện sự tiến bộ của phụ nữ; các yếu tố ảnh hưởng đến sự tham gia nghiên cứu khoa học của phụ nữ...); các hội thảo khoa học trong nước và quốc tế (công tác xã hội và sức khỏe cộng đồng, giảm nghèo bền vững, chất lượng giáo dục phổ thông,  bảo vệ, chăm sóc và giáo dục trẻ em, biến đổi chức năng gia đình trong thời kỳ công nghiệp hóa, hiện đại hóa...). </p>
      </div>
    </div> --}}
  </div>
</section>
@endsection
