@extends('layouts.app')

@section('title', 'List User')
<script>
  if (performance.navigation.type === 1) {
    window.location.href = "{{ route('dashboard') }}";
  }
</script>

@section('content')
<div class="container mt-4" >
  <h4 class="mb-4" style="font-family: Superhero; color: rgba(0, 0, 0, 0.968);">List Users</h4>

  <!--Success Message-->
  @if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif



  {{-- Users Table --}}
  <div class="table-responsive">
    <table class="table table-bordered table-striped align-middle">
      <thead class="table" style="background-color: pink ">
        <tr>
          <th style="width: 5%;">No</th>
          <th style="width: 25%;">Name</th>
          <th style="width: 30%;">Email</th>
          <th style="width: 15%;">User Privilege</th>
          <th style="width: 15%;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($users as $index => $user)
        <tr>
          <td>{{ $index + 1 }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role }}</td>



          <td style="text-align: center;">
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary" style="min-width: 70px;">
              <i class="bi bi-pencil-square"></i> Edit
            </a>

            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline-block;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" style="min-width: 70px;" onclick="return confirm('Are you sure?')">
                <i class="bi bi-trash"></i> Delete
              </button>
            </form>
          </td>



        </tr>
        @empty
        <tr>
          <td colspan="4" class="text-center">No users found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection