<section class="flat-filter-search-v2">
    <div class="flat-tab flat-tab-form">
        <div class="tab-content">
            <div class="tab-pane fade active show" role="tabpanel">
                <div class="form-sl">
                  <form action="{{ route('property.advance.search') }}" method="GET" enctype="multipart/form-data">   
                            @csrf
                            <div class="wd-find-select shadow-3">
                                <div class="inner-group">
                                    <div class="form-group-1 search-form form-style">
                                        
                                        @php
                                            $categories = App\Models\Category::orderBy('category_name_fr', 'ASC')->get();
                                        @endphp
                                        <div class="group-select form-group-2">
                                            <div class="" tabindex="0">
                                                <select name="category" class="form-control" cl id="">
                                                    <option  class="option" value="">Choisir une categorie</option>  
                                                    @foreach($categories as $item)                                                      
                                                    <option value="{{$item->id}}" class="option">{{$item->category_name_fr}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> 
                                
                                    </div>
                                    <div class="form-group-2 form-style">
                                       
                                        <div class="group-ip">
                                            <input type="text" class="form-control" placeholder="Saisir une ville" value="" name="city" title="Search for" >
                                            <a href="#" class="icon icon-location">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group-3 form-style">
                                        
                                        <input type="text" class="form-control" placeholder="Saisir Quartier" value="" name="street" title="Search for" >                                                   
                                    </div>
                                    
                                </div>
                                <div class="box-btn-advanced">
                                    <div class="form-group-4 box-filter">
                                        <a class="tf-btn btn-line filter-advanced pull-right">
                                            <span class="text-1">Option Avancée</span>
                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 12.375V3.4375M5.5 12.375C5.86467 12.375 6.21441 12.5199 6.47227 12.7777C6.73013 13.0356 6.875 13.3853 6.875 13.75C6.875 14.1147 6.73013 14.4644 6.47227 14.7223C6.21441 14.9801 5.86467 15.125 5.5 15.125M5.5 12.375C5.13533 12.375 4.78559 12.5199 4.52773 12.7777C4.26987 13.0356 4.125 13.3853 4.125 13.75C4.125 14.1147 4.26987 14.4644 4.52773 14.7223C4.78559 14.9801 5.13533 15.125 5.5 15.125M5.5 15.125V18.5625M16.5 12.375V3.4375M16.5 12.375C16.8647 12.375 17.2144 12.5199 17.4723 12.7777C17.7301 13.0356 17.875 13.3853 17.875 13.75C17.875 14.1147 17.7301 14.4644 17.4723 14.7223C17.2144 14.9801 16.8647 15.125 16.5 15.125M16.5 12.375C16.1353 12.375 15.7856 12.5199 15.5277 12.7777C15.2699 13.0356 15.125 13.3853 15.125 13.75C15.125 14.1147 15.2699 14.4644 15.5277 14.7223C15.7856 14.9801 16.1353 15.125 16.5 15.125M16.5 15.125V18.5625M11 6.875V3.4375M11 6.875C11.3647 6.875 11.7144 7.01987 11.9723 7.27773C12.2301 7.53559 12.375 7.88533 12.375 8.25C12.375 8.61467 12.2301 8.96441 11.9723 9.22227C11.7144 9.48013 11.3647 9.625 11 9.625M11 6.875C10.6353 6.875 10.2856 7.01987 10.0277 7.27773C9.76987 7.53559 9.625 7.88533 9.625 8.25C9.625 8.61467 9.76987 8.96441 10.0277 9.22227C10.2856 9.48013 10.6353 9.625 11 9.625M11 9.625V18.5625" stroke="#161E2D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>                                                                          
                                        </a>
                                    </div>
                                    <button type="submit" class="tf-btn btn-search primary">Recherche<i class="icon icon-search"></i> </button>
                                </div>
                                
                            </div>
                            <div class="wd-search-form">
                                <div class="grid-2 group-box group-price">
                                    <div class="group-select grid-2">
                                         <div class="box-select">
                                            <label class="title-select fw-6 form-group-2">Type</label>
                                            <div class="" tabindex="0">
                                                <select name="transaction" class="form-control" >
                                                    <option value="">Choisir un Type </option>
                                                    <option value="Vente">En Vente</option>
                                                     <option value="Location">Location</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-select">
                                            <label class="title-select fw-6 form-group-2">Type de Bien</label>
                                            <div class="" tabindex="0">
                                                <select name="category_type" class="form-control" >
                                                    <option value="">Choisir Type de Bien</option>
                                                    <option value="meuble">Meublé(e)</option>
                                                     <option value="non_meuble" >Non Meublé(e)</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="group-select grid-2">
                                        <div class="box-select">
                                            <label class="title-select fw-6 form-group-2">Prix Minimum (XAF)</label>
                                            <div class="" tabindex="0">
                                                <input type="number"  name="min_price" class="form-control" placeholder="saisir le Prix Minimum" min="1000">
                                            </div>
                                        </div>
                                        <div class="box-select">
                                            <label class="title-select fw-6 form-group-2">Prix Maximum (XAF)</label>
                                            <div class="" tabindex="0">
                                                <input type="number"  name="max_price" class="form-control" placeholder="saisir le Prix Maximum" min="1000">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="grid-2 group-box">
                                    <div class="group-select grid-2">
                                        <div class="box-select">
                                            <label class="title-select fw-6">Chambre(s)</label>
                                                <div class="" tabindex="0">
                                                <select name="bedrooms" class="form-control" id="">
                                                    <option value="">Choisir nombre chambre</option>
                                                    @for ($i=1;$i<=10;$i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-select">
                                            <label class="title-select fw-6">Douche(s)</label>
                                                <div class="" tabindex="0">
                                                <select name="bathrooms" class="form-control" id="">
                                                    <option value="">Choisir nombre douche</option>
                                                    @for ($i=1;$i<=10;$i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group-select grid-2">
                                        <div class="box-select">
                                            <label class="title-select fw-6">Salon(s)</label>
                                             <div class="" tabindex="0">
                                                <select name="suite" class="form-control" id="">
                                                    <option value="">Choisir nombre salon</option>
                                                    @for ($i=1;$i<=10;$i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                        <div class="box-select">
                                            <label class="title-select fw-6">Cuisine(s)</label>
                                             <div class="" tabindex="0">
                                                <select name="kitchen" class="form-control" id="">
                                                    <option value="">Choisir nombre cuisine</option>
                                                    @for ($i=1;$i<=10;$i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <div class="group-checkbox">
                                    <div class="text-1 text-black-2">Equipements:</div>
                                    <div class="group-amenities grid-6">               
                                        <div class="box-amenities">
                                            <fieldset class="amenities-item">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="climatiseur" id="cb1"> 
                                                <label for="cb1" class="text-cb-amenities">Climatiseur</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="jardin" id="cb8"> 
                                                <label for="cb8" class="text-cb-amenities">Jardin</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="garage" id="cb11"> 
                                                <label for="cb11" class="text-cb-amenities">Garage</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="adapté aux animaux" id="cb12"> 
                                                <label for="cb12" class="text-cb-amenities">Adapté aux animaux</label>
                                            </fieldset>
                                        </div>
                                        <div class="box-amenities">
                                            <fieldset class="amenities-item">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="chauffage" id="cb13"> 
                                                <label for="cb13" class="text-cb-amenities">Chauffage</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" value="starlink" class="tf-checkbox style-1" id="cb14"> 
                                                <label for="cb14" class="text-cb-amenities">Starlink</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="parking" id="cb15"> 
                                                <label for="cb15" class="text-cb-amenities">Parking</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="wifi" id="cb16"> 
                                                <label for="cb16" class="text-cb-amenities">WiFi</label>
                                            </fieldset>
                                        </div>
                                        <div class="box-amenities">
                                            <fieldset class="amenities-item">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="rénovation" id="cb17"> 
                                                <label for="cb17" class="text-cb-amenities">Rénovation</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="agent de securité" id="cb18"> 
                                                <label for="cb18" class="text-cb-amenities">Agent Sécurité</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="Piscine" id="cb19"> 
                                                <label for="cb19" class="text-cb-amenities">Piscine</label>
                                            </fieldset>
                                            <fieldset class="amenities-item mt-16">
                                                <input type="checkbox" name="spec_feat[]" class="tf-checkbox style-1" value="Restaurant" id="cb19"> 
                                                <label for="cb19" class="text-cb-amenities">Restaurant</label>
                                            </fieldset>
                                            
                                        </div>

                                    </div>
                                    
                                </div>
                            </div>
                  </form>
                </div>
            </div>
            
        </div>
    </div>
</section>