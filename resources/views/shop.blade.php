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
                <h3 class="card-title">THÊM SHOP</h3>
              </div>
              <!-- /.card-header -->
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
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Mã shop</label>
                    @if(isset($dataEdit))
                    <input type="hidden" name="flagUpdate" value="1">
                    <input type="text"  {{ isset($disabled) ? $disabled : null }}  class="form-control"  placeholder="Mã shop" value="{{$dataEdit['id_shop']}}">
                    <input type="hidden"  class="form-control" id="txtIdShop" name="txtIdShop" placeholder="Mã shop" value="{{$dataEdit['id_shop']}}">
                    @else
                      <input type="text" class="form-control" id="txtIdShop" name="txtIdShop" placeholder="Mã shop" value="{{ old('txtIdShop') }}">  
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tên shop</label>
                    @if(old('txtNameShop')==null)
                    <input type="text" class="form-control" id="txtNameShop" name="txtNameShop" placeholder="Tên shop" value="{{ isset($dataEdit) ? $dataEdit['name'] : null }}">
                    @else
                    <input type="text" class="form-control" id="txtNameShop" name="txtNameShop" placeholder="Tên shop" value="{{ old('txtNameShop') }}">
                    @endif
                  </div>
                  <div class="form-group">
                      <label for="sel1">Logo shop</label>
                      @if(old('txtLogo')==null)
                      <input type="text" class="form-control"  placeholder="Logo shop" name="txtLogo" value="{{ isset($dataEdit) ? $dataEdit['logo'] : null }}">
                      @else
                      <input type="text" class="form-control"  placeholder="Logo shop" name="txtLogo" value="{{ old('txtLogo') }}">
                      @endif
                    <textarea id="txtContent" name="txtContent"  class="form-control ckeditor" placeholder="Write your message.." rows="1"></textarea>
                    </div>
                    <script type="text/javascript">
                      CKEDITOR.replace('txtContent');
                    </script>
                    <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="txtTop" name="txtTop" @if(isset($dataEdit)) {{ $dataEdit['top']==1 ? 'checked' : null   }} @endif @if(old('txtTop')!=null) {{ 'checked' }}@endif>
                    <label class="form-check-label" for="txtTop">Top</label>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
          </div>
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
                      <th>TT</th>
                      <th>id</th>
                      <th>Name</th>
                      <th>Top</th>
                      <th>Logo</th>
                      <th>Created</th>
                      <th>Update</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; ?>
                  @foreach( $shop as $key => $value )
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $value->id_shop }}</td>
                      <td>{{ $value->name }}</td>
                      <td><input type="checkbox"  {{ $value->top==1 ? 'checked' : null }}></td>
                      <td>
                        <div id="menu_shop">                      
                          <div class="article">
                            <div class="log-shop-menu-thumb" style="background-image: url({{ url($value->logo) }});"> 
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>{{ $value->created_at }}</td>
                      <td>{{ $value->updated_at }}</td>
                      <td><a href="{{ url('home/shop/edit-shop/'.$value->id_shop) }}"><i class="material-icons">settings_applications</i></a></td>
                      <td><i class="material-icons" onclick="delete_shop('{{$value->id_shop}}','{{$value->name}}')" style="color: blue;cursor: pointer;">delete</i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $shop->links('vendor.pagination.simple-bootstrap-4') }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<!--   </div> -->
 <script type="text/javascript">
   function delete_shop(id,name) {
      if(confirm("Bạn có muốn xoá "+ name) == true){
          var url = "{{ url('home/shop/delete-shop') }}/" + id +"/" + name;
          window.location = url;
      }else{
           return;
      }
   }
 </script>
 <script  src="{{ asset('ckfinder/ckfinder.js') }}"> </script>
<script  src="{{ asset('ckeditor/ckeditor.js') }}"> </script>
<style type="text/css">
.menu_shop{
width: 100%;
height: auto;
padding: 5px;
}
.article {
    width: 170px;
    height: 50px;
    display: inline-block;
    padding: 5px;
    margin-left: 10px;
    vertical-align:top;
}
.log-shop-menu-thumb {
    width: 150px;
    height: 50px;
    background-image: none;
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
} </style>
@endsection
 

 