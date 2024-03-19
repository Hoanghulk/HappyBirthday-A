@extends('layouts.master')

@section('title')
    Add
@endsection

@section('content')
    <div class="container my-5">
        <div class="">

            <form action="{{ route('clients.banner.store') }}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="POST">
                <input type="hidden" name="_token" value="<?php echo csrf_token();?>">
                <div class="form-group">
                    <label>Mã màu nền</label>
                    <input type="text" name="background" class="form-control" placeholder="Nhập mã màu">
                    @error('background')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Tiêu đề nút</label>
                    <input type="text" name="button" class="form-control" placeholder="Nhập tiêu đề">
                    @error('button')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Địa chỉ đường dẫn</label>
                    <input type="text" name="button_link" class="form-control" placeholder="Nhập địa chỉ đường dẫn">
                    @error('button_link')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Nội dung</label>
                    <div id="editor"></div>
                    <input type="hidden" name="content" placeholder="Nhập nội dung">
                    @error('content')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Thứ tự</label>
                    <input type="text" name="order" class="form-control" placeholder="Nhập số thứ tự">
                    @error('order')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-group animated">
                    {{--                        <div class="alert"></div>--}}
                    <div id='img_container'>
                        <img id="preview" class="d-none" src="https://webdevtrick.com/wp-content/uploads/preview-img.jpg" alt="your image" title=''/>
                    </div>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" id="inputGroupFile01" name="image" class="imgInp custom-file-input" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="inputGroupFile01">Chọn file</label>
                        </div>
                    </div>
                    @error('image')
                    <span style="color: red">{{$message}}</span>
                    @enderror
                </div>

                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" name="status" class="form-check-input" >
                    <label class="form-check-label">Bật/Tắt</label>
                </div>
                <button type="submit" id="submit" class="btn btn-primary mt-3">Xác nhận</button>
            </form>
        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>

    <script>
        let editor;

        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( newEditor => {
                editor = newEditor;
            } )
            .catch( error => {
                console.error( error );
            } );

        document.querySelector( '#submit' ).addEventListener( 'click', () => {
            $('input[name="content"]').val(editor.getData());
        } );
    </script>

    <script>
        // Code By Webdevtrick ( https://webdevtrick.com )
        $("#inputGroupFile01").change(function(event) {
            RecurFadeIn();
            readURL(this);
        });
        $("#inputGroupFile01").on('click',function(event){
            RecurFadeIn();
        });
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var filename = $("#inputGroupFile01").val();
                filename = filename.substring(filename.lastIndexOf('\\')+1);
                reader.onload = function(e) {
                    $('#preview').removeClass('d-none');
                    $('#preview').attr('src', e.target.result);
                    $('#preview').hide();
                    $('#preview').fadeIn(200);
                    $('.custom-file-label').text(filename);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(".alert").removeClass("loading").hide();
        }
        function RecurFadeIn(){
            console.log('ran');
            FadeInAlert("Wait for it...");
        }
        function FadeInAlert(text){
            $(".alert").show();
            $(".alert").text(text).addClass("loading");
        }
    </script>
@endsection
