@extends ('layout')

@section ('content')

  <div class="mb-4 mt-4">
    <a class="btn btn-outline-info" href="/userdata/" role="button">
      View Available User Data <i class="fas fa-arrow-circle-right"></i>
    </a>
  </div>

  <div class="card mb-4">
    <div class="card-body">
      <div id="message"></div>
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
      <form action="/" method="POST" id="myForm">
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
        <button type="submit" class="btn btn-primary" id="submit"><i class="fas fa-check pr-2"></i>Submit Information</button>
      </form>
    </div>
  </div>

<script type="text/javascript">

  $("#myForm").submit(function(ev){ev.preventDefault();});

  function createMessageAlert(messages, status) {
    var messageDiv = document.createElement('div');
    var ul = document.createElement('ul');
    ul.className = 'mt-0 mb-0 pl-0';

    if (status === 0) {
      messageDiv.className = 'alert alert-danger';
    } else {
      messageDiv.className = 'alert alert-success';
    }

    for (let i = 0; i < messages.length; i++) {
      ul.appendChild(createListItem(messages[i], status));
    }

    messageDiv.appendChild(ul);
    document.getElementById('message').innerHTML = '';
    document.getElementById('message').appendChild(messageDiv);
  }

  function createListItem(message, status) {
    var li = document.createElement('li');
    li.style.cssText = 'list-style: none; text-transform: lowercase;';  
    
    if (status === 0) {
      li.innerHTML = '<i class="fas fa-times pr-2"></i>'
    } else {
      li.innerHTML = '<i class="fas fa-check pr-2"></i>'
    } 
    li.innerHTML += message;

    return li;
  }

  document.getElementById('submit').addEventListener('click', formSubmit);

  function formSubmit(event) {
    // event.preventDefault();
    let xhr = new XMLHttpRequest();

    xhr.open('GET', '/api/users/', true);

    xhr.onload = function() {
      if (this.status == 200) {
        var form = document.getElementById('myForm');
        if (form.checkValidity() === true) {
          if (document.getElementById('pincode').value.length != 6) {
            createMessageAlert(['pincode must be 6 digits'], 0);
          } else {
            document.getElementById('message').innerHTML = '';
          }
          var errors = {
            'name': 'name is required',
            'email': 'wrong email format',
            'pincode': 'pincode must be 6 digits'
          }
          var response = JSON.parse(this.responseText);
          // createMessageAlert(Object.values(errors), 0);
          console.clear();
        }
      }
    }

    xhr.send();
  }
</script>

@endsection
