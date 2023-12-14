<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/template/css/index.css">
    <link rel="stylesheet" href="../public/template/css/handbook.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../public/template/libries/fontawesome-free-6.4.0-web/css/all.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    #submitFromSearch{
        margin-left: -5px;
    }
   .colaps{
        top: 148px !important;
        height: 46px !important;
        left: 1117px !important;
        float: right !important;
        position: absolute !important;
        width: 44px !important;
    }
    .dropdown-menu{
    width:1115px !important;
    left:-245px !important;

}</style>
</head>
<div class="container">
@include('layouts.header')
</div>
<div class="text-align-center main-handbook">
    <h3>CẨM NANG</h3>
    <ul class="row list-handbook">
        @foreach ($handbook as $hand)
        <li class="card-handbook col-md-3">
            <div class="thumb-hanbook">
                <img src="../public/uploads/handbooks/{{$hand->image}}" alt
                    width="100̀̀%">
            </div>
            <div class="title-handbook">
                <a href="{{route('handbookDetail',['id'=>$hand->id])}}"> {{$hand->introduct}}</a>
            </div>
        </li>
        @endforeach


    </ul>
</div>
<div class="pagination">
    {{$handbook->links()}}
</div>


@include('layouts.footer')

</html>
