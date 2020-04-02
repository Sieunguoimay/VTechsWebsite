<div class="border border-dark p-4">
    <h5>Hệ thống pin {{$data->brand}} công suất {{$data->power}} - {{$data->amount}} tấm.</h5>
    <h5>Inverter {{$data->inverter}} {{$data->capacity}}- 1 cái.</h5>
    
    <div class="row text-center">
        <div class="col-md-4 col-sm-12 col-xs-12">
            <div>
                <svg height="160" width="160">
                    <circle cx="80" cy="80" r="80" fill="#82ca2e" />
                    <text x="80" y="85" dominant-baseline="middle" text-anchor="middle" fill="white" 
                        style="font-size:30px;font-weight: bold;">
                        {{$data->payback_period}}
                    </text>
                </svg>
            </div>
            <label>Thời gian hoàn vốn</label>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div>
                <svg height="160" width="160">
                    <circle cx="80" cy="80" r="80" fill="#82ca2e" />
                    <text x="80" y="85" dominant-baseline="middle" text-anchor="middle" fill="white" 
                        style="font-size:30px;font-weight: bold;">
                        {{$data->cost}}
                    </text>
                </svg>
            </div>
            <label>Tiền điện thu được 1 năm</label>
            <label>Giá dự thảo (1916 đồng)</label>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div>
                <svg height="160" width="160">
                    <circle cx="80" cy="80" r="80" fill="#82ca2e" />
                    <text x="80" y="85" dominant-baseline="middle" text-anchor="middle" fill="white" 
                        style="font-size:30px;font-weight: bold;">
                        {{$data->productivity}}
                    </text>
                </svg>
            </div>
            <label>Sản lượng điện 1 năm (kWh)</label>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <button class="btn btn-warning px-5" style="color:white;font-weight:bold;" data-toggle="modal" data-target="#model_info_form" id="btn_booking">ĐẶT HÀNG</button>
    </div>
</div>

<!-- Modal -->
<div id="model_info_form" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Chúng tôi sẽ liên lạc lại với bạn.</h4>
      </div>
      <div class="modal-body">
        {{-- {!! Form::open(['action'=>['PagesController@saveBookingInfo'],'method'=>'POST','enctype'=>'multipart/form-data'])!!} --}}
        <form class="form-horizontal" id="form_booking_info">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="form-group-lg mb-3">
                <label for="message">Tin nhắn:</label>
                <textarea class="form-control" rows="5" name="message"></textarea>
            </div>
            {{-- <div class="row justify-content-center">
                <button type="submit" class="btn btn-warning px-5" style="color:white;font-weight:bold;"  >GỬI ĐI</button>
            </div> --}}
        {{-- {!! Form::close()!!} --}}
        </form>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-warning px-5" data-dismiss="modal" style="color:white;font-weight:bold;" onclick="sendBookingInfo()">GỬI ĐI</button>
        {{-- <small>Chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể.</small>   --}}
      </div>
    </div>

  </div>
</div>