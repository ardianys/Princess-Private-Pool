<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Allotments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #FFB6C1, #87CEFA, #FFFFFF);
            background-size: 400% 400%;
            animation: gradientAnimation 8s ease infinite;
            position: relative;
            overflow-x: hidden;
            color: #333;
        }
        @keyframes gradientAnimation {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .sunlight-effect {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.2);
            background-image: radial-gradient(circle, rgba(255, 255, 255, 0.3) 1px, transparent 1px);
            pointer-events: none;
            z-index: 0;
        }
        .container {
            padding-top: 50px;
            z-index: 1;
            min-height: 100%;
            display: flex;
            flex-direction: column;
            text-align: center;
        }
        .card {
            border: none;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 10px;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }
        .card-body {
            padding: 30px;
        }
        .card h1 {
            font-size: 2.5rem;
            color: #8A2BE2;
            font-weight: bold;
            text-align: center;
            margin-bottom: 30px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .btn-primary, .btn-secondary, .btn-danger {
            background-color: #8A2BE2;
            border: none;
            padding: 8px 16px;
            font-size: 1rem;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            text-decoration: none;
        }
        .btn-primary:hover, .btn-secondary:hover, .btn-danger:hover {
            background-color: #7B1FA2;
        }
        .btn-danger {
            background-color: #dc3545;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .mt-3 {
            margin-top: 1rem;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="sunlight-effect"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h1>List Allotments</h1>
                        <a href="{{ route('allotments.create') }}" class="btn btn-primary mt-3">Add Allotment</a>
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <th>Swimming Pool</th>
                                    <th>Date</th>
                                    <th>Open</th>
                                    <th>Closed</th>
                                    <th>Price</th>
                                    <th>Amount People</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allotments as $allotment)
                                    <tr>
                                        <td>{{ $allotment->swimmingpool->name }}</td>
                                        <td>{{ $allotment->date }}</td>
                                        <td>{{ $allotment->open }}</td>
                                        <td>{{ $allotment->closed }}</td>
                                        <td>{{ $allotment->price_per_person }}</td>
                                        <td>{{ $allotment->total_person }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('allotments.edit', $allotment) }}" class="btn btn-secondary">Edit</a>
                                            <form action="{{ route('allotments.destroy', $allotment) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>