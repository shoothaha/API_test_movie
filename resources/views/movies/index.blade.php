<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MovieIndex</title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    </head>

    <body>

        <div class="container">

            @include('movies._messages')

            @foreach ($movies as $movie)
						
                <tr>
                    <th>{{ $movie->id }}</th>
                    <td>{{ $movie->name }}</td>
                    <td>{{ substr($movie->description, 0, 50) }} {{ strlen($movie->description) > 50 ? '...' : ''}}</td>
                    <td>{{ date('M j, Y H:m', strtotime($movie->created_at)) }}</td>
                    
                </tr>

            @endforeach

            @yield('content')

            <hr>

            <p class="text-center">J-M SMG test code</p>

        </div>  <!-- end of container -->

    </body>
</html>