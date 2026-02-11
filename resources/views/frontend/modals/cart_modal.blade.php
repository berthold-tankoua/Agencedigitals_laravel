  <div class="modal fade" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-body p-5">
                  <div class="position-absolute top-0 end-0 me-3 mt-3" id="quickViewModalLabel">
                      <button id="closeModalCart" type="button" class="btn-close" data-bs-dismiss="modal"
                          aria-label="Close"></button>
                  </div>
                  <div class="row">
                      <div class="col-lg-6">
                          <!-- product gallery -->
                          <div class="product-gallery">
                              <div class="slider slider-for">
                                  <div class="zoom" onmousemove="zoom(event)" style="background-image: ">
                                      <img id="pimage" src="" alt="product">
                                  </div>

                              </div>

                              <!-- products thumb -->
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ps-lg-8 mt-6 mt-lg-0">
                              <a href="#!" class="mb-3 d-block" id="pcategory">worrix</a>
                              <input type="hidden" id="product_id">
                              <h2 class="mb-1 h3" id="pname">AgenceDigitals</h2>
                              <div class="mb-4">
                                  <small class="text-warning">
                                      <i class="bi bi-star-fill"></i>
                                      <i class="bi bi-star-fill"></i>
                                      <i class="bi bi-star-fill"></i>
                                      <i class="bi bi-star-fill"></i>
                                      <i class="bi bi-star-half"></i></small>
                                  <a href="#" class="ms-2">(<span id="pviews"></span>) Vues</a>
                              </div>
                              <div class="fs-4">
                                  <span class="fw-bold theme-text-secondary"><span id="pprice"></span>
                                      {{ App\Utility\Utility::currency_code() }}<span id="action_type"></span></span>

                              </div>
                              <hr class="my-6">
                              <div class="row">

                                  <div class="col-md-4">
                                      <div class="form-group" id="sizeArea">
                                          <label for="psize" class="mb-2">Choisir une Taille</label>
                                          <select id="psize" name="psize" style="width: 90%;height:30px">

                                              <option value=""></option>

                                          </select>
                                      </div>
                                  </div>


                                  <div class="col-md-4">
                                      <div class="form-group" id="colorArea">

                                          <label for="pcolor" class="mb-2">Choisir une Couleur</label>
                                          <select id="pcolor" name="pcolor" style="width: 90%;height:30px">

                                              <option value=""></option>

                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="form-group">
                                          <label for="qty">Choisir une Quantité</label>
                                          <select id="qty" name="qty" style="width: 90%;height:30px">

                                              @for ($i = 1; $i < 50; $i++)
                                                  <option value="{{ $i }}">{{ $i }}</option>
                                              @endfor
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="mt-3 row justify-content-start g-2 align-items-center">
                                  <div class="mt-3 row justify-content-start g-2 align-items-center">
                                      <div class="col-lg-4 col-md-4 ">
                                          <!-- button -->
                                          <!-- btn -->
                                          <div class="custom-button">
                                              <button type="button" onclick="addToCarts()"
                                                  class="rounded-pill custom-btn-primary font-small button-effect justify-content-center align-items-center d-flex w-100">
                                                  <i class="bi bi-cart me-2" style="font-size: 20px"></i>Ajouter au
                                                  panier
                                              </button>
                                          </div>

                                      </div>
                                      <div class="col-md-5  ">
                                          <!-- button -->
                                          <!-- btn -->
                                          <div class="custom-button">

                                              <a id="plink" href="" title="Afficher plus de details"
                                                  class="rounded-pill custom-btn-primary btn btn-primary font-small button-effect justify-content-center align-items-center d-flex w-100"
                                                  style="background-color: rgb(0, 51, 255)">
                                                  <i class="bi bi-eye me-2" style="font-size: 20px"></i>En savoir plus
                                              </a>
                                          </div>

                                      </div>

                                  </div>
                              </div>
                              <hr class="my-6">
                              <div>

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
