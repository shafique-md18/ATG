@extends ('layout')

@section ('content')

  <div class="mb-4 mt-4">
    <a class="btn btn-outline-info" href="/userdata/" role="button">
      View Available User Data <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      @isset($message)
          <div class="{{ $message['classes'] }}">
            <ul class="mt-0 mb-0 pl-0">
                <li style="list-style: none;">
                  @if ($message['success'] == 0)
                  <i class="fas fa-times pr-2"></i>
                  @endif
                  @if ($message['success'] == 1)
                  <i class="fas fa-check pr-2"></i>
                  @endif
                  {{ $message['body'] }}
                </li>
            </ul>
          </div>
      @endisset
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul style="margin-top: 0; margin-bottom: 0;">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
          </ul>
        </div><br />
      @endif
      <h4 style="text-decoration: underline; font-family: Open Sans">
        <i class="far fa-plus-square pr-2"></i>Input New User Information</h4>
      <form action="/" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" 
              name="name" aria-
              describedby="emailHelp" 
              value="{{ old('name') }}" required>
            <small id="nameHelp" class="form-text text-muted">Please enter your name</small>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="email" 
            name="email" aria-describedby="emailHelp" 
            value="{{ old('email') }}" required>
          <small id="emailHelp" class="form-text text-muted">Please enter your email address</small>
        </div>
        <div class="form-group">
          <label for="pincode">Pincode</label>
          <input type="number" class="form-control" id="pincode" 
            name="pincode" value="{{ old('pincode') }}" required>
          <small id="pincodeHelp" class="form-text text-muted">Please enter your pincode(6 digits)</small>
        </div>
        <button type="submit" class="btn btn-primary"><i class="fas fa-check pr-2"></i>Submit Information</button>
      </form>
    </div>
  </div>

@endsection
