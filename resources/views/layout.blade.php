<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>(Shafique Mohammad) Across The Globe - Task Assignment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- BootStrap -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>  

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> 

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/57cbd50427.js" crossorigin="anonymous"></script>

        <style>
            .body {
                font-family: Open Sans;
            }
            .bottom {
                padding: 20px 20px;
            }

            .connect {
                font-size: 1.2rem;
            }
        </style>

    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-light bg-light mb-4 mt-4">
              <a class="navbar-brand" href="{{ url('/') }}" style="font-family: Open Sans 400; font-size: 1.8rem;">
                <i class="fas fa-home pr-2"></i>Home</a>
            </nav>

            @yield ('content')
            
            <div class="content bottom bg-light">
                <div class="links">
                    <p style="display: inline;" class="connect">Connect with me: </p>
                    <a href="https://shafique-md18.github.io" class="pl-4"><img src="https://img.icons8.com/fluent/64/000000/resume-website.png"/></a>
                    <a href="https://github.com/shafique-md18" class="pl-4"><img src="https://img.icons8.com/nolan/64/github.png"/></a>
                    <a href="https://www.linkedin.com/in/shafique-mohammad-099818129/" class="pl-4"><img src="https://img.icons8.com/cute-clipart/64/000000/linkedin.png"/></a>
                </div>
            </div>
        </div>
    </body>
</html>
