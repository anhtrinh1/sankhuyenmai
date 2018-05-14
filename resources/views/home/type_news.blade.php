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
                <h3 class="card-title">THÊM LOẠI TIN</h3>
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
                @if(isset($dataEdit))
              <!-- edit category -->
              <form  id="form_type_edit" action="{{ route($action) }}" method="POST">
                <div class="card-body">
               @csrf
                <input type="hidden" name="flagUpdate" value="1">
               <div class="form-group">
                <label>Mã Loại Tin</label>
                <input type="hidden" name="txtIdType" value="{{ $dataEdit->id }}">
                <input type="text" disabled="true" class="form-control"  value="{{ old('txtIdType')==null?$dataEdit->id:old('txtIdType') }}" >
              </div> 
              <div class="form-group">
                <label>Tên Loại tin</label>
                <input type="text" class="form-control" id="name-type" name="txtNameType"  value="{{ old('txtNameType')==null?$dataEdit->name:old('txtNameType') }}">
              </div>
              <div class="form-group">
                <label>Icon class</label>
                <input type="text" class="form-control" id="txtIconClass" name="txtIconClass"  value="{{ old('txtIconClass')==null?$dataEdit->icon_class:old('txtIconClass') }}">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
              </form>
              @else
              <!-- add new category -->
              <form  id="form_type" action="{{ route($action) }}" method="POST" >
               <div class="card-body">
               @csrf
                 <div class="form-group">
                  <label>Mã Loại Tin</label>
                  <input type="text" class="form-control" id="id-type" name="txtIdType" placeholder="Mã Loại Tin" value="{{ old('txtId')}}" >
                </div> 
                <div class="form-group">
                  <label>Tên Loại Tin</label>
                  <input type="text" class="form-control" id="name-type" name="txtNameType" placeholder="Tên Loại Tin" value="{{ old('txtNameType')}}">
                </div>
                <div class="form-group">
                  <label>Icon class</label>
                  <input type="text" class="form-control" id="txtIconClass" name="txtIconClass"  value="{{ old('txtIconClass')  }}">
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
              <div id="table_category" class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>TT</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Created</th>
                      <th>Updated</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach( $type as $value )
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $value['id'] }}</td>
                      <td>{{ $value['name'] }}</td>
                      <td>{{ $value['created_at'] }}</td>
                      <td>{{ $value['updated_at'] }}</td>
                      <td><a href="{{ url('home/type-new/edit-type-new/'.$value['id']) }}"><i class="material-icons">settings_applications</i></a></td>
                      <td><i class="material-icons" onclick="delete_type('{{$value['id']}}','{{$value['name']}}')">delete</i></td>
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
<script type="text/javascript">
   function delete_type(id,name) {
      if(confirm("Bạn có muốn xoá "+ name) == true){
          window.location="{{ url('home/type-new/delete-type-new') }}/" + id +"/" + name;
      }else{
           return;
      }
   }
 </script>
@endsection