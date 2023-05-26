<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Styles -->
</head>

<body class="container mt-5 mr-5">
    <div class="">
        <div class="row">
            <div class="col-md-12">
                @if (Session::get('pdfName'))
                    <span class="text text-success">
                        <h1>conversion of image to pdf successfully</h1>
                    </span>
                @else
                <h1>Conversion of Image to PDF</h1>
                @endif
                <form action="{{route('image.pdf')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Image to Pdf</label>
                            <input type="file" name="img" class="form-control mb-3">
                            @error('img')
                                <span class="text text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-responsive">
                    <thead>
                        <tr>
                            <th>PDF</th>
                            <th>View</th>
                            <th>Download</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @if(session('pdfName'))
                            <td><iframe src="{{ asset('storage/converted_images/' . session('pdfName')) }}" frameborder="0"></iframe></td>
                            <td><a href="{{asset('storage/converted_images/'. session('pdfName'))}}" target="_blank"><button class="btn btn-info">View</button></a></td>
                            <td><a href="{{asset('storage/converted_images/'. session('pdfName'))}}" target="_blank"><button class="btn btn-info">Download</button></a></td>
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

            <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">

                <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                </div>
            </div>
        </div>
    </div>
</body>

</html>
