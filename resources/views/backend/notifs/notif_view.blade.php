@extends('admin.admin_master')

@section('admin')
@section('title')
    AgenceDigitals | Notification
@endsection


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Main content -->
    <section class="content"><br>
        <div class="row justify-content-center">

            <!--========================================
            ADD CATEGORY SECTION
            =========================================-->
            <div class="col-8">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Envoyer Notification </h4>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('notif.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Selectionner un utilisateur <span class="text-danger">(Optionnel)</span></h5>
                                <div class="controls">
                                    <select name="user_id" class="form-control">
                                        <option value="" selected="" disabled="">Selectionner un utilisateur
                                        </option>
                                        @foreach ($pushs as $push)
                                            <option value="{{ $push->user_id }}">{{ $push->user_id }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Titre Notification<span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="title" class="form-control" required
                                        oninvalid="setCustomValidity('Saisir le titre de la notification')">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Text <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="body" class="form-control">
                                    @error('body')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Url <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="url" class="form-control"
                                        value="https://AgenceDigitals.com/">
                                    @error('url')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-info" value="Envoyer">
                            </div>
                        </form>
                    </div>
                </div> <!-- /.box -->
            </div> <!-- /.col-12 2 end -->

        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
@endsection
