@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Utilisateurs
@endsection


<!-- Content Wrapper. Contains page content -->
@php
    $users = App\Models\User::get();
@endphp
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Listes des Utilisateurs <span
                                class="badge badge-danger badge-pill">{{ count($users) }}</span> </h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="complex_header" class="table table-striped table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom</th>

                                        <th>Contact</th>

                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $item)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>

                                                <p><strong>Contact: </strong> {{ $item->phone }}</p>
                                            </td>

                                            <td>
                                                <p><strong>Email: </strong> {{ $item->email }}</p>
                                            </td>

                                            <td>
                                                @if ($item->role == 'user')
                                                    <p><strong>Role: </strong> Utilisateur</p>
                                                @elseif($item->role == 'deliver')
                                                    <p><strong>Role: </strong> Livreur</p>
                                                @else
                                                    <p><strong>Role: </strong> Administrateur</p>
                                                @endif

                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- /.col-md-6 1 end -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

<!-- /.content-wrapper -->


<script type="text/javascript">
    $(document).ready(function() {

        $('#image').change(function(e) {

            var reader = new FileReader();

            reader.onload = function(e) {
                $("#showImg").attr("src", e.target.result).width(80).height(80);
            }

            reader.readAsDataURL(e.target.files[0]);

        });

    });
</script>
@endsection
