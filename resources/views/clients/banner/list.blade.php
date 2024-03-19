@extends('layouts.master')

@section('title')
    List
@endsection

@section('content')
    <div class="section-table">
        <div class="container my-5">
            <h3>Danh sách banner quảng cáo</h3>

            <p>
                <a class="btn btn-success" href="../banner/store">Tạo mới banner</a>
            </p>

            <div class="data-table">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Background</th>
                        <th scope="col">button</th>
                        <th scope="col">button_link</th>
                        <th scope="col">content</th>
                        <th scope="col">order</th>
                        <th scope="col">image</th>
                        <th scope="col">status</th>
                    </tr>
                    </thead>


                    <tbody>
                    @foreach($banners as $item)
                        <tr id="numberId_{{ $item->id }}">
                            <td>
                                {{ $item->id }}
                            </td>
                            <td>
                                {{ $item->background }}
                            </td>
                            <td>
                                {{ $item->button }}
                            </td>
                            <td>
                                {{ $item->button_link }}
                            </td>
                            <td>
                                {!! $item->content !!}
                            </td>
                            <td>
                                {!! $item->order !!}
                            </td>
                            <td>
                                <img src="{{ $item->image }}" width="200px"/>
                            </td>
                            <td>
                                {!! $item->status !!}
                            </td>
                            <td>
                                <a href="{{ route('clients.banner.edit',['id' => $item->id]) }}"
                                   class="btn btn-primary">Cập nhật</a>

{{--                                // Xóa không dùng ajax--}}
{{--                                <a onclick="return confirm('Bạn có muốn chắc chắn xóa?')" href="{{ route('clients.banner.delete',['id' => $item->id]) }}"--}}
{{--                                   class="btn btn-danger">Xóa</a>--}}

{{--                                // Xóa  dùng ajax--}}
                                <a onclick="deleteBanner(this,'{{ $item->id }}')" href="javascript:void(0)" data-href="{{ route('clients.banner.delete',['id' => $item->id]) }}"
                                   class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('after-scripts-end')
    <script>
        function deleteBanner(el,id){
            let url = $(el).attr('data-href');
            if(confirm('Có chắc chắn muốn xóa không?')){
                $.ajax({
                    url: url,
                    method: 'delete',
                }).done((res) => {
                    if(res.success){
                        $('#numberId_'+id).remove();
                        // alert('Đã xóa thành công');
                        //thực hiện xóa dòng banner
                    }
                    else{
                        alert('Không thể xóa');
                        // báo lỗi
                    }
                })
            }
        }
    </script>
@endsection
