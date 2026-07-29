<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LaTeX to PDF Converter</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial, Helvetica, sans-serif;
        }

        body{
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .card{
            width:500px;
            background:#fff;
            padding:30px;
            border-radius:10px;
            box-shadow:0 0 15px rgba(0,0,0,.1);
        }

        h2{
            text-align:center;
            margin-bottom:10px;
        }

        p{
            text-align:center;
            color:#666;
            margin-bottom:25px;
        }

        input[type=file]{
            width:100%;
            padding:15px;
            border:2px dashed #bbb;
            border-radius:8px;
            margin-bottom:20px;
        }

        button{
            width:100%;
            padding:12px;
            border:none;
            border-radius:8px;
            background:#0d6efd;
            color:#fff;
            font-size:16px;
            cursor:pointer;
        }

        button:hover{
            background:#0b5ed7;
        }

        .alert{
            padding:15px;
            border-radius:8px;
            margin-bottom:20px;
            white-space:pre-wrap;
        }

        .error{
            background:#ffe5e5;
            color:#b00020;
        }

        .success{
            background:#d1f7d6;
            color:#146c2e;
        }

    </style>

</head>
<body>

<div class="card">

    <h2>LaTeX (.tex) to PDF</h2>

    <p>Upload your .tex file and download the generated PDF.</p>

    @if(session('error'))
        <div class="alert error">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('convert') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <input
            type="file"
            name="texfile"
            accept=".tex"
            required
        >

        <button type="submit">
            Convert to PDF
        </button>

    </form>

</div>

</body>
</html>