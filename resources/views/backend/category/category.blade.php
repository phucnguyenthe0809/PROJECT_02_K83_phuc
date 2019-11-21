@extends('backend.master.master')
@section('title','Danh Mục')
@section('content')
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-5">

                            <div class="form-group">
                                <label for="">Danh mục cha:</label>
                                <select class="form-control" name="parent" id="">
                                    <option value="0">----ROOT----</option>
                                    {{getCate($categories,0,"",0)}}
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tên Danh mục</label>
                                <input type="text" class="form-control" name="name" id="" placeholder="Tên danh mục mới">
                                {{showErrors($errors,'name')}}


                            </div>
                            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
                        </div>
                        <div class="col-md-7">
                            @if (session('thongbao'))
                                <div class="alert alert-success" role="alert">
                                    <strong>{{session('thongbao')}}</strong>
                                </div>
                            @endif

                            <h3 style="margin: 0;"><strong>Phân cấp Menu</strong></h3>
                            <div class="vertical-menu">
                                <div class="item-menu active">Danh mục </div>
                                    {{showCate($categories,0,"")}}

                                    <div class="category-fix">
                                        <a class="btn-category btn-primary" href="editcategory.html"><i class="fa fa-edit"></i></a>
                                        <a class="btn-category btn-danger" href="#"><i class="fas fa-times"></i></i></a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
        <!--/.col-->


    </div>
    <!--/.row-->
</div>
@endsection
@section('script')
    @parent

	<script>
		$('#calendar').datepicker({});

		! function ($) {
			$(document).on("click", "ul.nav li.parent > a > span.icon", function () {
				$(this).find('em:first').toggleClass("glyphicon-minus");
			});
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
			if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
			if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
    </script>

<script>
        function del(name){
            return confirm('Bạn thực sự muốn xóa danh mục ' + name +' này ?');
        }
    </script>
@endsection
