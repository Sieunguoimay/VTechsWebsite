@extends('layouts.app')
@section('style')
<style>
    .contact .social{
        padding:0;
    }
    .contact .social a{
        margin-right:10px;
        padding:0;
        font-size: 2em;
    }
</style>
@endsection
@section('content')
    <br><br><br>
    <div class="container padding">
        <div class="row">
            <h1>Về Công ty TNHH VTechs Việt Nam</h1>
        </div>
        <div class="row">
            <div class="col-md-4">
                <img class="img-fluid rounded" src="/storage/logos_and_icons/VTechsLogo.png">
            </div>
            <div class="col-md-8">
                </p>
                    <strong>Vtechs</strong> là công ty có kinh nghiệm lâu năm về năng lượng mặt trời áp mái với những công nghệ tiên tiến nhất, sản phẩm chất lượng được ứng dụng rộng rãi trên thế giới.
                    Chúng tôi đã mang đến cho rất nhiều hộ gia đình những nguồn điện kinh tế , nguồn điện được tái tạo vô tận với công nghệ kỹ thuật tốt nhất hiện nay. </p>
                <p>Chúng tôi tự tin sẽ là điểm sáng trong ngành năng lượng tái tạo của Việt Nam. </p>
                <p>Với mục tiêu cụ thể và rõ ràng, chúng tôi sẽ đem đến cho gia đình bạn sự tiện lợi nhất.
                    <strong>Công ty TNHH Vtechs</strong> cam kết uy tín, chất lượng và tư vấn tận tình cho gia đình bạn.</p>
                <div class="container-fluid">
                    <div class="row contact">
                        @include('inc.social')
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
@endsection
@section('script')
<script>SendNewViewToServer('about',0);</script>
@endsection
