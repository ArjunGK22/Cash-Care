<x-layout>
    <x-sidebar>
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employee Details</h5>
                            <form action="/employees/{{ $empData->id }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td><input type="text" class="form-control" name="name"
                                                    value="{{ $empData['name'] }}"></td>
                                        </tr>
                                        <tr>
                                            <th>Phone</th>
                                            <td><input type="text" class="form-control" name="phone"
                                                    value="{{ $empData['phone'] }}"></td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td><input type="text" class="form-control" name="email"
                                                    value="{{ $empData['email'] }}"></td>
                                        </tr>
                                        <tr>
                                            <th>Date of Birth</th>
                                            <td><input type="date" class="form-control" name="dob"
                                                    value="{{ $empData['dob'] }}"></td>
                                        </tr>
                                        <tr>
                                            <th>Aadhar Number</th>
                                            <td><input type="text" class="form-control" name="aadhar_no"
                                                    value="{{ $empData['aadhar_no'] }}"></td>
                                        </tr>
                                        <tr>
                                            <th>PAN Number</th>
                                             <td><input type="text" class="form-control" name="pan_no"
                                                    value="{{ $empData['pan_no'] }}"></td>
                                        </tr>
                                        <tr >
                                            <td colspan="2"><button type="submit" class="btn btn-primary">Update </button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-sidebar>
</x-layout>
