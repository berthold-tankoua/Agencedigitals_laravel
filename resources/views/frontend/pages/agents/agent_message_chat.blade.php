@extends('frontend.main_master')

@section('content')
@section('title')
    AgenceDigitals | Chat
@endsection

<!-- start main container -->
<main class="bg-light">
    <section class="container">

        <!-- Preloader Start -->
        @include('frontend.components.agent_header')

        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="box">
                        <div class="box-body">
                            <div class="single-sidebar fixed-sidebar">
                                <div class="flat-tab flat-tab-form widget-filter-search widget-box">
                                    <div class="d-flex align-items-center justify-content-between " style="height: 50px">
                                        <div class="mb-2">
                                            <h6 class="">{{ $user->name }} </h6>
                                            <span class="text-secondary">En ligne il y'a:
                                                {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                        </div>
                                        @if ($user->isOnline())
                                            <span class="bg-success"
                                                style="border-radius: 5px;padding: 2px 5px 2px 5px;;color:white;font-size:10px">En
                                                ligne</span>
                                        @else
                                            <span class="bg-danger"
                                                style="border-radius: 5px;padding: 2px 5px 2px 5px;;color:white;font-size:10px">Hors
                                                ligne</span>
                                        @endif
                                    </div><br>
                                    <p class="border p-2" style="border-radius: 5px;"><span
                                            style="font-weight: bold">Message:</span> {{ $chat->message }}</p>
                                </div>
                                <div class="widget-box single-property-contact">

                                    @auth
                                        <div class="contact-form">
                                            <div class="ip-group">
                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="{{ $user->id }}" class="form-control">
                                                <input type="hidden" name="store_id" id="store_id"
                                                    value="{{ $user->store_id }}" class="form-control">
                                                <input type="hidden" name="message_id" id="message_id"
                                                    value="{{ $chat->id }}" class="form-control">
                                            </div>

                                            <div class="ip-group">
                                                <textarea name="response" id="response" rows="2" tabindex="2" placeholder="Message" aria-required="true"></textarea>
                                            </div>
                                            <button id="AgentSendMsg"
                                                class="tf-btn btn-view primary hover-btn-view w-100">Envoyer message <span
                                                    class="icon icon-arrow-right2"></span></button>
                                        </div>
                                    @else
                                        <div class="mt-2">
                                            <a target="_blank" rel="noopener noreferrer"
                                                href="{{ url('user/login/demand') }}" title="Se connecter"
                                                class="tf-btn btn-view btn primary hover-btn-view w-100"
                                                style="font-size:20px;"><span class="fas fa-message"></span> Se
                                                connecter</a>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.col-md-6 1 end -->
            </div>
        </div>
    </section>
</main>
<script>
    $("#AgentSendMsg").click(function(e) {
        e.preventDefault();
        user_id = $("#user_id").val();
        store_id = $("#store_id").val();
        message_id = $("#message_id").val();
        response = $("#response").val();

        var data = new FormData();
        data.append('user_id', user_id);
        data.append('store_id', store_id);
        data.append('message_id', message_id);
        data.append('response', response);

        $.ajax({
            url: "/agent/send/msg/response",
            type: 'POST',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(data) {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000,
                    customClass: {
                        popup: 'my-toast-font'
                    }
                })

                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success
                    })
                } else {
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error
                    })
                }

            }

        }); // end ajax

    }); // end one
</script>
<!-- end main container -->
@endsection
