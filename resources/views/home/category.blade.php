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
                <h3 class="card-title">THÊM DANH MỤC</h3>
              </div>
              <!-- /.card-header -->
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

              @if(isset($dataEditCategory))
              <!-- edit category -->
              <form  id="form_category_edit" action="{{ route($action_cate_edit) }}" method="POST">
                <div class="card-body">
               @csrf
               <input type="hidden" name="flagUpdate" value="1">
               <div class="form-group">
                <label>Mã Danh Mục</label>
                <input type="hidden" name="txtIdCategory" value="{{ $dataEditCategory->id_category }}">
                <input type="text" disabled="true" class="form-control" id="id-category"  value="{{ $dataEditCategory->id_category }}"  >
              </div> 
              <div class="form-group">
                <label>Tên Danh Mục</label>
                <input type="text" class="form-control" id="txtNameCategory" name="txtNameCategory"  value="{{ old('txtNameCategory')==null?$dataEditCategory->name:old('txtNameCategory') }}">
              </div>
              <div class="form-group">
                <label>Icon</label>
                <input type="text" class="form-control" id="txtIcon" name="txtIcon"  value="{{ old('txtIcon')==null?$dataEditCategory->icon_class:old('txtIcon') }}">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
              </form>
              @else
              <!-- add new category -->
              <form  id="form_category" action="{{ route($action_cate) }}" method="POST"  >
               <div class="card-body">
               @csrf
               <div class="form-group">
                <label>Mã Danh Mục</label>
                <input type="text" class="form-control" id="id-category" name="txtIdCategory" placeholder="Mã Danh Mục" value="{{ old('txtIdCategory') }}">
              </div> 
              <div class="form-group">
                <label>Tên Danh Mục</label>
                <input type="text" class="form-control" id="name-category" name="txtNameCategory" placeholder="Tên Danh Mục" value="{{ old('txtNameCategory') }}">
              </div>
              <div class="form-group">
                <label>Icon</label>
                <input type="text" class="form-control" id="txtIcon" name="txtIcon" placeholder="class='form-control'" value="{{ old('txtIcon')}}">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
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
                  <thead><tr>
                      <th>TT</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Icon Class</th>
                      <th>Created</th>
                      <th>Updated</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach( $category as $value )
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $value['id_category'] }}</td>
                      <td>{{ $value['name'] }}</td>
                      <td>{{ $value['icon_class'] }}</td>
                      <td>{{ $value['created_at'] }}</td>
                      <td>{{ $value['updated_at'] }}</td>
                      <td><a href="{{ url('home/category/edit-category/'.$value['id_category']) }}"><i class="material-icons">settings_applications</i></a></td>
                      <td><i class="material-icons" onclick="delete_cate('{{$value['id_category']}}','{{$value['name']}}')">delete</i></td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<script type="text/javascript">
   function delete_cate(id,name) {
      if(confirm("Bạn có muốn xoá "+ name) == true){
          window.location="{{ url('home/category/delete-category') }}/" + id +"/" + name;
      }else{
           return;
      }
   }
 </script>
@endsection