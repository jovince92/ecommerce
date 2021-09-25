<div class="col-md-2"> 
    <br> 
    <img class="card-img-top" style="border-radius: 50%" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" height="100%" width="100%">
    <br>
    <ul class="list-group list-group-flush">
        <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm btn-block">Home</a>
        <a href="{{ route('profile') }}" class="btn btn-primary btn-sm btn-block">Profile</a>
        <a href="{{ route('password.show') }}" class="btn btn-primary btn-sm btn-block">Change Password</a>
        <a href="{{ route('order.history') }}" class="btn btn-primary btn-sm btn-block">Order History</a>
        <br>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-info btn-sm btn-block">Logout</button>
        </form>
    </ul>
</div>