@foreach($users as $user)
    <a href="#" class="list-group-item">{{ $user->username }}</a>
@endforeach