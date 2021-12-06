<!DOCTYPE html>
<html>
<head>
    <title>url shortener </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
   
<div class="container">
    <h1>Laravel url shortener </h1>
    <p>(Using Default Domain)</p>
    <div class="card">
      <div class="card-header">
        <form method="POST" action="{{ route('generate.shorten.link.post') }}">
            @csrf
            <div class="input-group mb-3">
              <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-success" type="submit">Generate Shorten Link</button>
              </div>
            </div>
        </form>
      </div>
      <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($shortLinks as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><a href="{{ route('shorten.link', $row->code) }}" target="_blank">{{ route('shorten.link', $row->code) }}</a></td>
                            <td>{{ $row->link }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>
</div>
<br>
<div class="container">
    <p>(Using Custom Domain)</p>
    <div class="card">
      <div class="card-header">
        <button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal">Add New Domain</button>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Domain</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="POST" action="{{ route('add.new.domain.post') }}">
                    @csrf
                        <input type="url" name="domain_name" class="form-control" placeholder="http://example.com" aria-label="Recipient's domain" aria-describedby="basic-addon2"><br>
                        <button type="submit" class="btn btn-success" >Save</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <br><br>
        <form method="POST" action="{{ route('custom.domain.post') }}">
        @csrf
            <div class="input-group mb-3">
                <select class="form-control" name="domain">
                    @foreach($domains as $domain)
                    <option value="{{ $domain->id }}">{{ $domain->domain_name }} </option>
                    @endforeach
                </select>
                <input type="text" name="link" class="form-control" placeholder="Enter URL" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Generate Shorten Link</button>
                </div>
            </div>
        </form>
      </div>
      <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Short Link</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($shortLinks as $row)
                    <tr>
                        {{$row->domain->domain_name}}
                        <td>{{ $row->id }}</td>
                        <td><a href="{{ $row->domain->domain_name.'/'.$row->code }}" target="_blank">{{ $row->domain->domain_name.'/'.$row->code }}</a></td>
                        <td>{{ $row->link }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
      </div>
    </div>
</div>
</body>
</html>