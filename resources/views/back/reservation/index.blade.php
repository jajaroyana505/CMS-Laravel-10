@extends('back.layout.template')
@section('title', 'Reservations List - Admin')

@section('content')

<!-- content -->

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Reservation</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>

            </ul>
        </div>
        <div class="row">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success')}}
            </div>

            @endif

            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Reservation List</h3>
                        <div class="mb-3">
                            <a href="{{ url('users/create')}}" class="btn btn-rounded btn-primary">
                                <i class="fas fa-plus me-2"></i>
                                Create Reservation
                            </a>
                        </div>
                    </div>


                    <div id="reservasi">

                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="start" class="form-label">Filter start</label>
                                <input type="date" name="start" id="fillterStart" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="end" class="form-label">Filter end</label>
                                <input type="date" name="end" id="fillterEnd" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 ">
                            <button type="button" onclick="loadReservations()" class="btn btn-primary mb-2">Filter</button>
                        </div>
                    </div>
                    <table id="reservations-table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th colspan="13">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data reservasi akan di-load di sini melalui AJAX -->


                        </tbody>
                    </table>


                </div>
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ url('reservations')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" name="date" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label">Time</label>
                                <input type="time" name="time" id="" step="3600" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>



        </div>
    </div>
</div>



@endsection

@push('js')
<script>
    function addReservation(element) {
        // console.log()
        // alert(element.data('date'));
        const date = $(element).data('date');
        const time = $(element).data('time');
        alert(`Tanggal: ${date}, Waktu: ${time}`);
    }
    $(document).ready(function() {

    });

    loadReservations()

    function loadReservations() {

        $.ajax({
            url: "/reservations", // Route Laravel
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Tambahkan token CSRF untuk Laravel
            },
            data: {
                start: $("#fillterStart").val(),
                end: $("#fillterEnd").val(),
            },
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    let reservations = response.data;
                    let tableBody = '';

                    // Looping data yang diterima dari server
                    reservations.forEach(function(day) {
                        tableBody += '<tr>';
                        tableBody += '<th>' + day.date + '</th>';

                        day.times.forEach(function(time) {
                            if (time.status === 'booked') {
                                tableBody += '<td class="bg-success">' + time.time + '</td>';
                            } else {
                                tableBody += '<td >' + '<a href="#" onclick="addReservation(this)" data-date="' + day.date + '" data-time="' + time.time + '">' + time.time + '</a>' + '</td>';
                            }
                        });

                        tableBody += '</tr>';
                    });

                    // Masukkan data ke tabel
                    $('#reservations-table tbody').html("");

                    $('#reservations-table tbody').html(tableBody);
                }
            },
            error: function(xhr, status, error) {
                console.log('Error:', error);
            }
        });
    }
</script>

@endpush