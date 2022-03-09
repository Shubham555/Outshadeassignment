
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">@auth
                {{Auth::user()->name}}
            @endauth</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('dashboard')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('manageprofile')}}">Manage Profile</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('createevent')}}">Create Events</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('logout')}}">Logout</a>
                </li>
              </ul>
            </div>
          </nav>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-4">
                List Of Invitaion
            </div>
            <div class="col-8">
                <table class="table">
                    <caption>List of Invitation</caption>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Invited By</th>
                        <th scope="col">Event Name</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($invitations as $key=>$invitation)
                        <tr>
                          <th scope="row">{{$key + 1}}</th>
                          <td>@foreach ($allusers as $alluser)
                              @if($alluser->id == $invitation->createdby)
                              {{$alluser->name}}
                              @endif
                          @endforeach</td>
                          <td>{{$invitation->name}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                List Of Your Events
            </div>
            <div class="col-8">
                <table class="table">
                    <caption>List of Events</caption>
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event Name</th>
                        <th scope="col">Update</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $key=>$event)
                      <tr>
                        <th scope="row">{{$key + 1}}</th>
                        <td>{{$event->name}}</td>
                        <td><a href="/eventupdate/{{$event->id}}">Update</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          {{-- {{$events->links()}} --}}
                        </ul>
                      </nav>
                    </div>
            </div>

        </div>
    </div>
    
</body>
</html>