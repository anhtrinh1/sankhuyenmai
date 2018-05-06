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
                <h3 class="card-title">THÊM TIN TỨC </h3>
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
                <!-- edit -->
                @if(isset($dataEdit))
              <!-- edit category -->
              <form method="POST" action="{{ route($action) }}" name="formshop">
                <div class="card-body">
               @csrf
               <div class="form-group">
                <label for="sel1">Tiêu đề</label>
                 <input class="form-control" type="txt" value="{{  $dataEdit->id }}" disabled>
                 <input type="hidden" name="txtId" value="{{ $dataEdit -> id }}{{ old('txtId') }}">
              </div>
               <div class="form-group">
                <label for="sel1">Shop</label>
                <select  class="form-control"  name="txtShop[]" id="txtShop" multiple>
                  @foreach( $news_shop as $value )
                  <option value="{{ $value['id_shop'] }}" selected="true">{{ $value['name'] }}</option>
                  @endforeach
                  @foreach( $shop as $value )
                  <option value="{{ $value['id_shop'] }}" >{{ $value['name'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">Danh mục</label>
                <select   class="form-control" name="txtCategory" id="txtCategory"  >
                  <option></option>
                   @foreach( $category as $value )
                    @if(old('txtCategory') == $value['id_category'] )
                      <option value="{{ $value['id_category']  }}" selected>{{ $value['name']  }}</option>
                    @elseif($dataEdit->id_category == $value['id_category'])
                     <option value="{{ $dataEdit->id_category  }}" selected>{{ $dataEdit->name  }}</option>
                    @else
                      <option value="{{ $value['id_category']  }}">{{ $value['name']  }}</option>
                    @endif 
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">Loại Tin</label>
                <select class="form-control" name="txtTypeNew" id="txtTypeNew"  >
                  <option></option>
                   @foreach( $typeNew as $value )
                     @if(old('txtTypeNew') == $value['id'] )
                      <option value="{{ $value['id']  }}" selected>{{ $value['name']  }}</option>
                      @elseif($dataEdit->id_type_new == $value['id'])
                      <option value="{{ $dataEdit->id_type_new }}" selected>{{ $dataEdit->name_type_new  }}</option>
                      @else
                      <option value="{{ $value['id'] }} ">{{ $value['name'] }}</option>
                     @endif
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="sel1">Tiêu đề</label>
                 <input class="form-control" type="text" value="{{ old('txtTitle')==null ? $dataEdit->title : old('txtTitle')}}"  name="txtTitle">
              </div>
              <div class="form-group col-6">
                <label for="sel1">Mô tả</label>
                 <input class="form-control" type="text" value="{{ old('txtDescription')==null ? $dataEdit->description : old('txtDescription')}}"  name="txtDescription">
              </div>
              <div class="form-group">
                <label for="sel1">link ảnh hiện thị</label>
                 <input class="form-control" type="text"  name="txtLinkImg" value="{{ old('txtLinkImg')==null ? $dataEdit->link_img : old('txtLinkImg')}}"   }}">
              </div>
              <div class="form-group">
                <label for="sel1">Nội dung</label>
              <textarea id="txtContent" name="txtContent"   class="form-control ckeditor" placeholder="Write your message..">{{ old('txtContent')==null ? html_entity_decode($dataEdit->content) : html_entity_decode(old('txtContent')) }}</textarea>
              </div>
              <script type="text/javascript">
                CKEDITOR.replace('txtContent');
              </script> 
               <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="txtDisplay" name="txtDisplay" @if(old('txtDisplay')==null) {{ $dataEdit->display==1 ? 'checked' : null   }} @else {{ 'checked'}} @endif>
                    <label class="form-check-label" for="txtTop">Display</label>
                  </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"  id="txtNewFeed" name="txtNewFeed" @if(old('txtNewFeed')==null) {{ $dataEdit->news_feed==1 ? 'checked' : null   }} @else {{ 'checked'}} @endif >
                    <label class="form-check-label" for="txtTop">Newfeed</label>
                  </div>
              <!-- <div class="form-group col-1">
                <label for="sel1">Display</label>
                 <input type="checkbox" class="form-control" id="txtDisplay" name="txtDisplay" @if(old('txtDisplay')==null) {{ $dataEdit->display==1 ? 'checked' : null   }} @else {{ 'checked'}} @endif>
              </div>
              <div class="form-group col-1">
                <label for="sel1">Newfeed</label>
                <input type="checkbox" class="form-control" id="txtNewFeed" name="txtNewFeed" @if(old('txtNewFeed')==null) {{ $dataEdit->news_feed==1 ? 'checked' : null   }} @else {{ 'checked'}} @endif >
              </div> -->
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
              </form>
              @else
              <!-- add new category -->
              <form  method="POST" action="{{ route($action) }}" name="formshop">
               <div class="card-body">
               @csrf
                 <div class="form-group">
                  <label for="sel1">Shop</label>
                  <select  class="form-control"  name="txtShop[]" id="txtShop" multiple>
                     @foreach( $shop as $value )
                     @if(old('txtShop') == $value['id_shop'] )
                      <option value="{{ $value['id_shop']  }}" selected>{{ $value['name']  }}</option>
                      @else
                      <option value="{{ $value['id_shop'] }}">{{ $value['name'] }}</option>
                     @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Danh mục</label>
                  <select class="form-control" name="txtCategory" id="txtCategory"  >
                    <option></option>
                     @foreach( $category as $value )
                       @if(old('txtCategory') == $value['id_category'] )
                        <option value="{{ $value['id_category']  }}" selected>{{ $value['name']  }}</option>
                        @else
                        <option value="{{ $value['id_category'] }} ">{{ $value['name'] }}</option>
                       @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Loại Tin</label>
                  <select class="form-control" name="txtTypeNew" id="txtTypeNew"  >
                    <option></option>
                     @foreach( $typeNew as $value )
                       @if(old('txtTypeNew') == $value['id'] )
                        <option value="{{ $value['id']  }}" selected>{{ $value['name']  }}</option>
                        @else
                        <option value="{{ $value['id'] }} ">{{ $value['name'] }}</option>
                       @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="sel1">Tiêu đề</label>
                   <input class="form-control" type="text" placeholder="Tiêu đề" name="txtTitle" value="{{ old('txtTitle') }}">
                </div>
                <div class="form-group">
                  <label for="sel1">Mô tả</label>
                   <input class="form-control" type="text" placeholder="Mô Tả" name="txtDescription" value="{{ old('txtDescription')}}">
                </div>
                <div class="form-group">
                  <label for="sel1">link ảnh hiện thị</label>
                   <input class="form-control" type="text"  name="txtLinkImg" value="{{ old('txtLinkImg') }}">
                </div>
                <div class="form-group">
                  <label for="sel1">Shop</label>
                <textarea id="txtContent" name="txtContent"   class="form-control ckeditor" placeholder="Write your message..">{{ old('txtContent') }}</textarea>
                </div>
                <script type="text/javascript">
                  CKEDITOR.replace('txtContent');
                </script> 
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="txtDisplay" {{ old('txtDisplay')!=null ? 'checked' : null }}>
                    <label class="form-check-label" for="txtTop">Display</label>
                  </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="txtNewFeed" {{ old('txtNewFeed')!=null ? 'checked' : null }}>
                    <label class="form-check-label" for="txtTop">Newfeed</label>
                  </div>
                <!-- <div class="form-group col-1">
                  <label for="sel1">Display</label>
                   <input class="form-control" type="checkbox"  name="txtDisplay" {{ old('txtDisplay')!=null ? 'checked' : null }}>
                </div> -->
                <!-- <div class="form-group col-1">
                  <label for="sel1">Newfeed</label>
                   <input class="form-control" type="checkbox"  name="txtNewFeed" {{ old('txtNewFeed')!=null ? 'checked' : null }}>
                </div> -->
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
                      <th>TT</th>
                      <th>id</th>
                      <th>Title</th>
                      <th>views</th>
                      <th>Display</th>
                      <th>New Feed</th>
                      <th>Created</th>
                      <th>Updated</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = 1; ?>
                    @foreach( $news as $key => $value  )
                      
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $value['id']}}</td>
                        <td>{{ $value['title']}}</td>
                        <td>{{ $value['views']}}</td>
                        <td>@if($value['display'] == 1) <i class="material-icons" style="color:green">check_circle</i>
                            @else<i class="fa fa-close" style="color:red"></i>
                            @endif
                        </td>
                        <td>@if($value['news_feed'] == 1) <i class="material-icons" style="color:green">check_circle</i>
                            @else<i class="fa fa-close" style="color:red"></i>
                            @endif
                        </td>
                        <td>{{ $value['created_at'] }}</td>
                        <td>{{ $value['updated_at'] }}</td>
                        <td><a href="{{ url('home/news/edit-news/'.$value['id']) }}"><i class="material-icons">settings_applications</i></a></td>
                        <td><i class="material-icons" onclick="_delete('{{$value['id']}}','{{$value['title']}}')" style="color: blue;cursor: pointer;">delete</i></td>
                      </tr>
                      @endforeach
                  </tbody>
                </table>
                {{ $news->links() }}
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<script type="text/javascript">
 function _delete(id,name) {
  if(confirm("Bạn có muốn xoá "+ name) == true){
    var url = "{{ url('home/news/delete-news') }}/" + id +"/" + name;
    window.location = url;
  }else{
   return;
 }
}
</script>


<script  src="{{ asset('ckfinder/ckfinder.js') }}"> </script>
<script  src="{{ asset('ckeditor/ckeditor.js') }}"> </script>
@endsection