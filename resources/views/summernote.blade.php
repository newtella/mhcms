<!DOCTYPE html>

<html>

<head>

	<title>Laravel 5 - Summernote Wysiwyg Editor with Image Upload Example</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" />

    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <!-- include summernote css/js-->

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>

</head>

<body>

<form method="POST" action="{{ route('summernote.post') }}">

    {{ csrf_field() }}

	<div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Details:</strong>

            <textarea class="form-control summernote" name="detail"></textarea>

        </div>

     </div>

     <div class="col-xs-12 col-sm-12 col-md-12 text-center">

        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

</form>


</body>
<script type="text/javascript">


     $('.summernote').summernote({
        

           height: 300,

      });

  

</script>


</html>