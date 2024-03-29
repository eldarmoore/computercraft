@extends('cms.cms_master')

@section('cms_content')

    <h1 class="page-header">Categories</h1>
    <p>Here you can edit site categories</p>

    <div class="row">
        <div class="col-md-12">
            <p><a class="btn btn-primary" href="{{ url('cms/categories/create') }}">+ Add new category</a></p>
            @if($categories)
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <th>Url</th>
                        <th>Last Update</th>
                        <th>Operation</th>
                    </tr>
                    @foreach($categories as $cat)

                        @if($cat['sub_category'] == 0)
                        <tr>
                            <td>{{ $cat['title'] }}</td>
                            <td><a target="_blank" href="{{ url( 'shop/' . $cat['url'] ) }}">shop/{{ $cat['url'] }}</a></td>
                            <td style="text-align: center">{{ $cat['updated_at'] }}</td>
                            <td style="text-align: center">
                                <a href="{{ url('cms/categories/' . $cat['id'] . '/edit') }}">Edit</a> |
                                <a href="{{ url('cms/categories/' . $cat['id']) }}">Delete</a>
                            </td>
                        </tr>
                        @endif

                        @foreach($categories as $sub_cat)

                            @if($sub_cat['sub_category'] == $cat['id'])

                                <?php $cat_url = $cat['url'] . "/" . $sub_cat['url']  ?>

                                <tr>
                                    <td>{{ $sub_cat['title'] }}</td>
                                    <td><a target="_blank" href="{{ url( 'shop/' . $cat_url ) }}">shop/{{ $cat_url }}</a></td>
                                    <td style="text-align: center">{{ $sub_cat['updated_at'] }}</td>
                                    <td style="text-align: center">
                                        <a href="{{ url('cms/categories/' . $sub_cat['id'] . '/edit') }}">Edit</a> |
                                        <a href="{{ url('cms/categories/' . $sub_cat['id']) }}">Delete</a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                </table>
            @endif
        </div>
    </div>

@endsection