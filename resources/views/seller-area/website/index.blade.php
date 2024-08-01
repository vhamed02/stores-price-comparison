<h1>My websites</h1>
@if($sellerWebsites)
    <table border="bordered">
        <thead>
        <tr>
            <th>Row</th>
            <th>Title</th>
            <th>URL</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sellerWebsites as $key => $website)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $website->title  }}</td>
                <td>{{ $website->url  }}</td>
                <td>{{ $website->description  }}</td>
                <td>
                    <a href="{{ route('seller.website.products.index', $website->id) }}">
                        <button>View Products</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <style>
        th,td {
            padding: 10px;
        }
    </style>
@endif
