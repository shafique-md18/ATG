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
            <input type="text" class="form-control" id="nameInput" 
              name="name" aria-
              describedby="emailHelp" 
              value="{{ old('name') }}" required>
            <small id="nameHelp" class="form-text text-muted">Please enter your name</small>
        </div>
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="email" class="form-control" id="emailInput" 
            name="email" aria-describedby="emailHelp" 
            value="{{ old('email') }}" required>
          <small id="emailHelp" class="form-text text-muted">Please enter your email address</small>
        </div>
        <div class="form-group">
          <label for="pincode">Pincode</label>
          <input type="number" class="form-control" id="pincodeInput" 
            name="pincode" value="{{ old('pincode') }}" required>
          <small id="pincodeHelp" class="form-text text-muted">Please enter your pincode(6 digits)</small>
        </div>
        <button type="submit" class="btn btn-primary" id="submitButton"><i class="fas fa-check pr-2"></i>Submit Information</button>
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
    document.getElementById('message').appendChild(messageDiv);

    setTimeout(function(){ document.getElementById('message').innerHTML = '' }, 2000);
  }

  function createListItem(message, status) {
    var li = document.createElement('li');
    li.style.cssText = 'list-style: none;';  
    
    if (status === 0) {
      li.innerHTML = '<i class="fas fa-times pr-2"></i>'
    } else {
      li.innerHTML = '<i class="fas fa-check pr-2"></i>'
    } 
    li.innerHTML += message;

    return li;
  }

  $(document).ready(function() {
    $('#myForm').on('submit', function (event) {
      if (document.getElementById('pincodeInput').value.length != 6) {
        createMessageAlert(['Pincode must be 6 digits'], 0);
        return;
      }

      document.getElementById('submitButton').innerHTML = 'Submitting...';
      document.getElementById('submitButton').disabled = true;

      $.ajax({
        data: {
          name: $('#nameInput').val(),
          email: $('#emailInput').val(),
          pincode: $('#pincodeInput').val()
        },
        type: 'POST',
        url: '/api/users/'
      })
      .done(function (data) {
        if (data.status === 0) {
          createMessageAlert(Object.values(data.errors), 0);
        } else {
          createMessageAlert(["Information submitted successfully! Email Sent !"], 1)
        }
        document.getElementById('submitButton').innerHTML = '<i class="fas fa-check pr-2"></i>Submit Information';
        document.getElementById('submitButton').disabled = false;
      });
    });
  });
</script>

@endsection
