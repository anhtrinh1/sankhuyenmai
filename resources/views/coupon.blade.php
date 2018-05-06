@extends('layouts.homelayout')

@section('content')
<!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">THÊM MÃ KHUYẾN MÃI</h3>
              </div>
              <!-- /.card-header -->
              <div class="d-flex justify-content-between   align-items-center pb-2 mb-3 border-bottom">
                 <span class="menu_coupon" onclick="open_form('form_coupon')">Thêm khuyến mãi<i class="material-icons btn">note_add</i></span> 
                <span class="menu_coupon">Loại Khuyến mãi<i class="material-icons btn">note_add</i></span>
                <span class="menu_coupon">Loại Khuyến mãi<i class="material-icons btn">note_add</i></span>
                 
              </div>
              <!-- form start -->
              <div id="add"> 
                @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
                @endif
               @if ($errors->any())
                <div class="alert alert-danger">
                  <ul>
                    @foreach ($errors->all() as $error)
                    <li><b>{{ $error }}</b></li>
                    @endforeach
                  </ul>
                </div>
                @endif
              <!-- edit coupon -->
              @if(isset($dataEditCoupon))
              <!-- edit category -->
              <form  id="form_coupon" action="{{ route($action_coupon_edit) }}" method="POST">
                <div class="card-body">
               @csrf
                <div class="form-group">
                  <div class="form-group">
                  <label>id</label>
                  <input type="text" disabled="true" class="form-control"  value="{{ $dataEditCoupon->id_coupon }}"  >
                  <input type="hidden" id="txtIdCoupon"  name="txtIdCoupon" value="{{ $dataEditCoupon->id_coupon }}">
                </div>
                <div class="form-group">
                  <label for="sel1">Shop</label>
                  <select class="form-control" id="selectIdShop" name="selectIdShop" >
                    <option></option>
                    @foreach( $shop as $value )
                      @if( old('selectIdShop')==$value['id_shop'] )
                        <option value="{{ $value['id_shop']  }}" selected>{{ $value['name']  }}</option>
                      @elseif( $value['id_shop'] == $dataEditCoupon->id_shop )
                        <option value="{{ $dataEditCoupon->id_shop }}" selected>{{ $dataEditCoupon->name_shop }}</option>
                      @else
                        <option value="{{ $value['id_shop']  }}">{{ $value['name']  }}</option>
                      @endif 
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Loại coupon</label>
                  <select class="form-control" id="selectIdType" name="selectIdType" >
                   <option></option>
                   @foreach( $type as $value )
                      @if(old('selectIdType') == $value['id'] )
                        <option value="{{ $value['id']  }}" selected>{{ $value['name']  }}</option>
                      @elseif($value['id'] == $dataEditCoupon->id_type)
                        <option value="{{ $dataEditCoupon->id_type }}" selected>{{ $dataEditCoupon->name_type }}</option>
                      @else
                        <option value="{{ $value['id']  }}">{{ $value['name']  }}</option>
                      @endif 
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Danh Mục</label>
                  
                  <select class="form-control" id="selectIdCategory" name="selectIdCategory"  >
                    <option></option>
                    @foreach( $category as $value )
                      @if(old('selectIdCategory') == $value['id_category'] )
                        <option value="{{ $value['id_category']  }}" selected>{{ $value['name']  }}</option>
                      @elseif(old('selectIdCategory') == null)
                        <option value="{{ $dataEditCoupon->id_category  }}" selected>{{ $dataEditCoupon->name_category  }}</option>
                      @else
                        <option value="{{ $value['id_category']  }}">{{ $value['name']  }}</option>
                      @endif 
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tiêu Đề</label>
                  <input type="text" class="form-control" id="txtTitle" value="{{old('txtTitle')==null ? $dataEditCoupon->title : old('txtTitle')}}" name="txtTitle" placeholder="Tiêu đề">
                </div>
                <div class="form-group">
                  <label>Mã Khuyến Mãi</label>
                  <input type="text" class="form-control" id="txtCouponCode" value="{{ old('txtCouponCode')==null ? $dataEditCoupon->coupon_code : old('txtCouponCode')}}" name="txtCouponCode"  placeholder="Mã Khuyến Mãi">
                </div>
                <div class="form-group">
                  <label>Phần trăm khuyến mãi</label>
                  <input type="text" class="form-control" id="txtPercent" name="txtPercent"  placeholder="% Khuyến Mãi" value="{{ old('txtPercent')==null ? $dataEditCoupon->percent : old('txtPercent')}}">
                </div>
                <div class="form-group">
                  <label>Ngày Bắt đầu</label>
                  <input type="date" class="form-control" id="startDay" value="{{ old('startDay')==null ? $dataEditCoupon->start_day : old('startDay') }}" name="startDay"  placeholder="Ngày bắt đầu">
                </div>
                <div class="form-group">
                  <label>Ngày Hết Hạn</label>
                  <input type="date" class="form-control" id="endDay" value="{{ old('endDay')==null ? $dataEditCoupon->end_day : old('endDay')  }}" name="endDay" placeholder="Ngày hết hạn">
                </div>
              <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="txtDisplay" name="txtDisplay" @if(old('txtDisplay')==null) {{ $dataEditCoupon->display==1 ? 'checked' : null   }} @else {{ 'checked'}} @endif>
                    <label class="form-check-label" for="txtTop">Display</label>
                  </div>
                <div class="form-group">
                  <label>Link</label>
                  <input type="text" class="form-control" id="txtLink" value="{{ old('txtLink')==null ? $dataEditCoupon->link : old('txtLink') }}" name="txtLink" placeholder="Link">
                </div>
                <div class="form-group">
                  <label>Linh ảnh</label>
                  <input type="text" class="form-control" id="txtLinkImg" value="{{ old('txtLinkImg')==null ? $dataEditCoupon->link_img  : old('txtLinkImg') }}" name="txtLinkImg" placeholder="Link ảnh hiện thị">
                </div>
                <div class="form-group">
                  <label>Lưu ý</label>
                  <textarea class="form-control" id="note"  name="txtNote" placeholder="Lưu ý">{{ old('txtNote')==null ? $dataEditCoupon->notes : old('txtNote')}}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
              </form>
              @else
              <!-- add new category -->
              <form  id="form_coupon" action="{{ route($action_coupon) }}" method="POST">
               <div class="card-body">
               @csrf
                <div class="form-group">
                  <label for="sel1">Shop</label>
                  <select class="form-control" id="selectIdShop" name="selectIdShop" >
                    <option></option>
                    @foreach( $shop as $value )
                      @if(old('selectIdShop') == $value['id_shop'] )
                       <option value="{{ $value['id_shop'] }}" selected>{{ $value['name'] }}</option>
                      @else
                       <option value="{{ $value['id_shop'] }} ">{{ $value['name'] }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Danh Mục</label>
                  <select class="form-control" id="selectIdCategory" name="selectIdCategory"  >
                    <option></option>
                     @foreach( $category as $value )
                     @if(old('selectIdCategory') == $value['id_category'] )
                      <option value="{{ $value['id_category']  }}" selected>{{ $value['name']  }}</option>
                      @else
                      <option value="{{ $value['id_category'] }} ">{{ $value['name'] }}</option>
                     @endif
                    @endforeach
                  </select>
                </div>
                 <div class="form-group">
                  <label for="sel1">Loại coupon</label>
                  <select class="form-control" id="selectIdType" name="selectIdType"  >
                    <option></option>
                     @foreach( $type as $value )
                      @if(old('selectIdType') == $value['id'] )
                        <option value="{{ $value['id']  }}" selected>{{ $value['name']  }}</option>
                      @else
                        <option value="{{ $value['id']  }}">{{ $value['name']  }}</option>
                      @endif 
                      
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>Tiêu Đề</label>
                  <input type="text" class="form-control" id="title" name="txtTitle" placeholder="Tiêu đề" value="{{ old('txtTitle') }}">
                </div>
                <div class="form-group">
                  <label>Mã Khuyến Mãi</label>
                  <input type="text" class="form-control" id="coupon" name="txtCouponCode"  placeholder="Mã Khuyến Mãi" value="{{ old('txtCouponCode') }}">
                </div>
                <div class="form-group">
                  <label>Phần trăm khuyến mãi</label>
                  <input type="text" class="form-control" id="txtPercent" name="txtPercent"  placeholder="% Khuyến Mãi" value="{{ old('txtPercent') }}">
                </div>
                <div class="form-group">
                  <label>Ngày Bắt đầu</label>
                  <input type="date" class="form-control" id="start_day" name="startDay"  placeholder="Ngày bắt đầu" value="{{ old('startDay') }}">
                </div>
                <div class="form-group">
                  <label>Ngày Hết Hạn</label>
                  <input type="date" class="form-control" id="end_day" name="endDay" placeholder="Ngày hết hạn" value="{{ old('endDay') }}">
                </div>
            <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="txtDisplay" {{ old('txtDisplay')!=null ? 'checked' : null }}>
                    <label class="form-check-label" for="txtTop">Display</label>
                  </div>
                <div class="form-group">
                  <label>Link</label>
                  <input type="text" class="form-control" id="txtLink" name="txtLink" placeholder="Link" value="{{ old('txtLink') }}">
                </div>
                <div class="form-group">
                  <label>Linh ảnh</label>
                  <input type="text" class="form-control" id="txtLinkImg" name="txtLinkImg" placeholder="Link ảnh hiện thị" value="{{ old('txtLinkImg') }}">
                </div>
                <div class="form-group">
                  <label>Lưu ý</label>
                  <textarea class="form-control" id="note" name="txtNote" placeholder="Lưu ý">{{ old('txtNote') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
              @endif
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th width="50px">TT</th>
                      <th width="50px">Id</th>
                      <th width="120px">Title</th>
                      <th width="100px">Couponcode</th>
                      <th width="100px">Link</th>
                      <th width="100px">start_day</th>
                      <th width="100px">end_day</th>
                      <th width="50px">number_click</th>
                      <th width="200px">notes</th>
                      <th width="100px">shop</th>
                      <th width="100px">category</th>
                       <th width="50px"></th>
                      <th width="50px"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; ?>
                  @foreach( $coupon as $value )
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $value->id }}</td>
                      <td>{{ $value->title }}</td>
                      <td>{{ $value->coupon_code }}</td>
                      <td>{{ $value->link }}</td>
                      <td>{{ $value->start_day }}</td>
                      <td>{{ $value->end_day }}</td>
                      <td>{{ $value->number_click }}</td>
                      <td>{{ $value->notes }}</td>
                      <td>{{ $value->name_shop }}</td>
                      <td>{{ $value->name_category }}</td>
                      <td><a href="{{ url('home/coupon/edit-coupon/'.$value->id) }}"><i class="material-icons">settings_applications</i></a></td>
                      <td><i class="material-icons" onclick="delete_coupon('{{ $value->id }}','{{ $value->id }}')">delete</i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                 {{ $coupon->links('vendor.pagination.simple-bootstrap-4') }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">
  function open_form(id) {
       if(document.getElementById(id).style.display == "block")
          document.getElementById(id).style.display = "none";
        else
          document.getElementById(id).style.display = "block";
    }

    function close_form(id) {
       if(document.getElementById(id).style.display == "none")
          document.getElementById(id).style.display = "block";
        else
          document.getElementById(id).style.display = "none";
    }
   function delete_coupon(id,name) {
      if(confirm("Bạn có muốn xoá "+ name) == true){
          window.location="{{ url('home/coupon/delete-coupon') }}/" + id +"/" + name;
      }else{
           return;
      }
   }
    
 </script>
@endsection