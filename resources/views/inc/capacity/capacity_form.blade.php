
<div class="container-fluid">
    <div class="row">
        <div class="col-12 p-0">
            <div class="card p-3">
                <div class="card-title text-center m-0 p-0">
                    <h3>Tính toán thiết kế theo nhu cầu!</h3>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-8">
                                <h5>Chọn công suất hệ thống (kW): </h5>
                                <form class="multi-range-field mt-3 text-center">
                                    <input type="range" class="custom-range" min="0" max="3" id="capacity_range" style="width:80%;" value="1">
                                </form>
                                <div class="row text-center">
                                    <div class="col-3"><label>3kW</label></div>
                                    <div class="col-3"><label>5kW</label></div>
                                    <div class="col-3"><label>10kW</label></div>
                                    <div class="col-3"><label>15kW</label></div>
                                </div>
                                <h5>Chọn hàng: </h5>
                                <div class="row text-center">
                                    <div class="col-4 form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="product1" value="option1">
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="col-4 form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="product2" value="option2" checked>
                                        <span class="checkmark"></span>
                                    </div>
                                    <div class="col-4 form-check">
                                        <input class="form-check-input" type="radio" name="exampleRadios" id="product3" value="option3">
                                        <span class="checkmark"></span>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col-4"><label>Tiết kiệm</label></div>
                                    <div class="col-4"><label>Tiêu chuẩn </label></div>
                                    <div class="col-4"><label>Cao cấp</label></div>
                                </div>
                                <div class="row p-0 m-0 justify-content-center">
                                    <button class="btn btn-warning px-5" style="color:white;font-weight:bold;" onclick="calculateAndShowResult()">TÍNH TOÁN</button>
                                </div>
                            </div>
                        </div>
                        <div class="row p-0 justify-content-center">
                            <div class="col-11 p-0">
                                <span id="technical_info_display"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function calculateAndShowResult(){
    var capacity = document.getElementById('capacity_range').value;
    var quality = 0;
    if(document.getElementById('product2').checked){
        quality = 1;
    }else if(document.getElementById('product3').checked){
        quality = 2;
    }


    // console.log(capacity,quality);

    httpPostRequest('/query_by_capacity','{"capacity":'+capacity+',"quality":'+quality+'}',function(response){
        var data = JSON.parse(response);
        if(data.status="OK"){
            document.getElementById('technical_info_display').innerHTML = data.html;
        }
        // console.log(response);
    });
}

function sendBookingInfo(){
    var capacity = document.getElementById('capacity_range').value;
    var quality = 0;
    if(document.getElementById('product2').checked){
        quality = 1;
    }else if(document.getElementById('product3').checked){
        quality = 2;
    }

    var form = new FormData(document.getElementById('form_booking_info'));
    var jsonStr = 
        '{"email":"'+form.get('email')
            +'","phone":"'+form.get('phone')
            +'","message":"'+form.get('message')
            +'","other_data":{"capacity":'+capacity+',"quality":'+quality+'}}';
    console.log("Sending",jsonStr);

    httpPostRequest('/send_booking_info',jsonStr,function(response){
        var data = JSON.parse(response);
        console.log(response);
        if(data.status="OK"){
            alert("Gửi thông tin thành công!");
        }else{
            alert("Đã có lỗi. Có thể bạn muốn gửi lại thông tin lần nữa.");
        }
        // console.log(response);
    });
}

</script>