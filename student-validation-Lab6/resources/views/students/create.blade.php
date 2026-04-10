<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Student</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header bg-dark text-white text-center rounded-top-4">
            <h4>Create Student</h4>
        </div>

        <div class="card-body p-4">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="/students/store" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
    <label class="form-label">Profile Image</label>
    <input type="file" name="image" class="form-control">

    @error('image')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name') }}" placeholder="Enter name">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" placeholder="Enter email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Age -->
                <div class="mb-3">
                    <label class="form-label">Age</label>
                    <input type="number" name="age" class="form-control"
                           value="{{ old('age') }}" placeholder="Enter age">
                    @error('age')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control"
                           placeholder="Enter password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">
                        Create Student
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>