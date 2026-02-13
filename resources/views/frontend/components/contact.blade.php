<div class="row g-4 gx-5 justify-content-center">
    <div class="col-lg-7">
        <div class="p-4 bg-color-op-3 rounded-1">
            <form name="contactForm" id="contact_form" method="post" action="{{ route('add.contact.store') }}">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <input type="text" name="name" id="name" class="form-control" placeholder="Votre nom"
                            required>
                    </div>

                    <div class="col-md-6">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="Votre email" required>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="phone" id="phone" class="form-control"
                            placeholder="Numéro de téléphone" required>
                    </div>

                    <div class="col-md-6">
                        <div class="relative">
                            <select name="subject" id="services" class="form-control">
                                <option value="Accompagnement" selected>Consultation ou audit gratuit
                                </option>
                                <option value="Site Web">Création ou refonte de site web</option>
                                <option value="Agent IA">Agent IA & automatisation</option>
                                <option value="Marketing Digital">Marketing digital (référencement,
                                    publicité en ligne)</option>
                                <option value="SEO">Optimisation pour les moteurs de recherche
                                </option>
                                <option value="Formations">Formations en ligne</option>
                            </select>
                            <i class="absolute top-0 end-0 id-color pt-3 pe-3 icofont-simple-down"></i>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <textarea name="message" id="message" class="form-control h-100px" placeholder="Votre message" required></textarea>
                    </div>

                    <div class="col-md-12">
                        <div class="text-center">
                            <div id='submit'>
                                <input type='submit' id='send_message' value='Envoyer le message' class="btn-main">
                            </div>
                        </div>
                    </div>
                </div>

                <div id="success_message" class='success'>
                    Votre message a été envoyé avec succès. Rechargez la page si vous souhaitez en
                    envoyer un autre.
                </div>
                <div id="error_message" class='error'>
                    Désolé, une erreur est survenue lors de l’envoi du formulaire.
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="h-100 bg-color-2 text-light p-20 rounded-1">

            <div class="relative mb-4">
                <i class="abs fs-32 p-3 bg-white rounded-1 icofont-location-pin id-color-2"></i>
                <div class="ms-80px">
                    <div class="fw-bold text-white">Localisation</div>
                    Ontario, Canada
                </div>
            </div>

            <div class="relative mb-4">
                <i class="abs fs-32 p-3 bg-white rounded-1 icofont-envelope id-color-2"></i>
                <div class="ms-80px">
                    <div class="fw-bold text-white">Envoyez un message</div>
                    contact@agencedigitals.com
                </div>
            </div>

            <div class="relative mb-4">
                <i class="abs fs-32 p-3 bg-white rounded-1 icofont-phone id-color-2"></i>
                <div class="ms-80px">
                    <div class="fw-bold text-white">Appelez-moi</div>
                    +1 (942) 388-8634
                </div>
            </div>

        </div>
    </div>
</div>
