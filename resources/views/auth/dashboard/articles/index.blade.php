@extends('layouts.app')
@section('content')
<table id="articlesindex" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>User</th>
                <th></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Title</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>User</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    @endsection

    @section('script')
<script type="text/javascript" >

$(document).ready(function() {
    $('#articlesindex').DataTable( {
        "ajax": "data/objects.txt",
        "columns": [
            { "data": "title" },
            { "data": "name" },
            { "data": "category" },
            { "data": "Status" },
            { "data": "User" }
            
        ]
    } );
} );

</script>
@endsection
