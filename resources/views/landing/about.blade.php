@extends('layouts/landing')
 
@section('page-title')
 Komunitas Fotografi Telkom | About
@endsection

@section('content')   
    <!-- Head Section -->
    <section class="small-section bg-dark-lighter mt-80">
        <div class="relative container align-left">
            
            <div class="row">
                
                <div class="col-sm-12">
                    <h1 class="hs-line-11 font-alt mb-0 text-center">About Us</h1>
                </div>
            </div>
            
        </div>
    </section>
    <!-- End Head Section -->
    <!-- About Section -->
    <section class="page-section pt-50 pb-0" id="about">
        <div class="container relative">
            
            <div class="section-text mb-40 mb-sm-20">
                <div class="row">
                    
                    <div class="col-sm-12 mb-sm-50 mb-xs-30">
                        
                        <h3 class="hs-line-11 font-alt mb-10 text-center hs-hr">KFT: Beyond Images</h3>
                        @if(isset($beyondImages))
                        <p class="text-justify mb-0">
                            <b>{{ $beyondImages->title }}</b> {{ $beyondImages->content }} 
                        </p>
                        @endif
                    </div>
                </div>
            </div>

            <div>
                <h3 class="hs-line-11 font-alt mb-40 mb-sm-20 text-center hs-hr">Our Teams</h3>
            </div>
            
            <!-- Team -->
            <div class="row multi-columns-row about-team">
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-irfan.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> irfan.tachrir@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/tumiskangkung" target="_blank">Irfan A. Tachrir</a> 
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> -
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/irfantachrir" target="_blank">irfantachrir</a>
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> -
                                </p>
                            </div>
                        </div>
                        



                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                IRFAN A TACHRIR
                            </div>
                            
                            <div class="team-item-role">
                                Board Of Executive
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-ery.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> ery.punta@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/hendraswara" target="_blank">hendraswara</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/phuntos" target="_blank">phuntos</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/phunto" target="_blank">phunto</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        



                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                Ery Punta Hendraswara
                            </div>
                            
                            <div class="team-item-role">
                                Board Of Executive
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-blank.jpg') }}" alt="" />
                            
                            <div class="team-item-detail">
                                <p>
                                   -
                                </p>
                            </div>
                        </div>
                        



                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                -
                            </div>
                            
                            <div class="team-item-role">
                                Board Of Executive
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <div class="clearfix mb-50 mb-sm-10"></div>

                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-arif.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> arifrudiana@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> N/A
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> N/A
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/arifrudiana" target="_blank">arifrudiana</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> <a href="http://photoblog.com/arifrudiana" target="_blank">photoblog.com/arifrudiana</a> 
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                               Arif Rudiana
                            </div>
                            
                            <div class="team-item-role">
                                Chief Executive Officer (CEO)
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <!-- Team Item -->
                <div class="col-sm-4 mb-sm-30 wow fadeInUp">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-taufik.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> taufikzamzami@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/taufikz" target="_blank">taufikz</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/taufikzamzami73" target="_blank">taufikzamzami73</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/taufikzamzami" target="_blank">taufikzamzami</a>
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/taufikzamzami.daily" target="_blank">taufikzamzami.daily</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                               TAUFIK ZAMZAMI
                            </div>
                            
                            <div class="team-item-role">
                                Chief Technology Officer (CTO)
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-ichwan.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> icha7203@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/ichwanmuttaqin" target="_blank">ichwanmuttaqin</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/icha7203" target="_blank">icha7203</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/icha7203" target="_blank">icha7203</a>
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                ICHWAN MUTTAQIN
                            </div>
                            
                            <div class="team-item-role">
                                Chief Marketing Officer (CMO)
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <div class="clearfix mb-50 mb-sm-10"></div>

                <!-- Team Item -->
                <div class="col-sm-4 mb-sm-30 wow fadeInUp">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-julius.jpg') }}" alt="" />

                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> romedly@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/romedly" target="_blank">romedly</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/romi_psyche" target="_blank">romi_psyche</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/romedly">romedly</a>
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                JULIUS ROMEDLY
                            </div>
                            
                            <div class="team-item-role">
                                Secretary I
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->
                
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-firdaus.jpg') }}" alt="" />

                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> nutrihadi@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/nutrihadi" target="_blank">nutrihadi</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/Nutrihadi" target="_blank">Nutrihadi</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/firdausnutrihadi" target="_blank">firdausnutrihadi</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                FIRDAUS NUTRIHADI
                            </div>
                            
                            <div class="team-item-role">
                                Secretary II
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-kenneth.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> kennmoto@outlook.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/liyinshen" target="_blank">liyinshen</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/kennethlii" target="_blank">kennethlii</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/kennmoto" target="_blank">kennmoto</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                Kenneth Li
                            </div>
                            
                            <div class="team-item-role">
                                Bendahara
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <div class="clearfix mb-50 mb-sm-10"></div>
                
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-bhimo.jpg') }}" alt="" />

                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> bhiezoel@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/bhiezoel" target="_blank">bhiezoel</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> <a href="http://twitter.com/bhiezoel" target="_blank">bhiezoel</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/bhiezoel" target="_blank">bhiezoel</a>
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                BIMO SULISTYO
                            </div>
                            
                            <div class="team-item-role">
                                Development Dept.
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->
                
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-suleksono.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> suleksono@gmail.com
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/Sulek" target="_blank">Sulek</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> N/A
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/suleksono" target="_blank">suleksono</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                Suleksono
                            </div>
                            
                            <div class="team-item-role">
                                Creative Dept.
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->
                
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-andreas.jpg') }}" alt="" />
                            
                            <div class="team-item-detail align-left">
                                <p class="mb-10 mt-40">
                                    <img src="images/icon-gm.png"> N/A
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-fb.png"> <a href="http://facebook.com/andreas.arfianto" target="_blank">andreas.arfianto</a>
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-tw.png"> N/A
                                </p>
                                <p class="mb-10">
                                    <img src="images/icon-ig.png"> <a href="http://instagram.com/andreas0718" target="_blank">andreas0718</a> 
                                </p>
                                <p class="mb-0">
                                    <img src="images/icon-web.png"> N/A
                                </p>
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                Andreas Arfianto
                            </div>
                            
                            <div class="team-item-role">
                                Education &amp; Communication Dept
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <div class="clearfix mb-50 mb-sm-10"></div>
                
                
                
            </div>
            <!-- End Team -->

            <div>
                <h3 class="hs-line-11 font-alt mb-40 mb-sm-20 text-center hs-hr">Contact Us</h3>
            </div>
            

            <div class="row">
                <div class="col-md-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4716.692523788663!2d106.816088123305!3d-6.2307585872961155!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f158843078e3%3A0xce64d3c98a332ab0!2sTelkom+Landmark+Tower!5e0!3m2!1sen!2sid!4v1524450504540" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <div class="col-md-6">
                    <!-- Phone -->
                        <div class="col-xs-12 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    Call Us
                                </div>
                                <div class="ci-text">
                                    +62853-3029-0872
                                </div>
                            </div>
                        </div>
                        <!-- End Phone -->
                        
                        <!-- Address -->
                        <div class="col-xs-12 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    Address
                                </div>
                                <div class="ci-text">
                                    Telkom Landmark Tower, Jakarta
                                </div>
                            </div>
                        </div>
                        <!-- End Address -->
                        
                        <!-- Email -->
                        <div class="col-xs-12 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    Email
                                </div>
                                <div class="ci-text">
                                    <a href="mailto:kftelkom@gmail.com">kftelkom@gmail.com</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->
                        
                        <!-- Instagram -->
                        <div class="col-xs-12 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-instagram"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    Instagram
                                </div>
                                <div class="ci-text">
                                    <a href="http://instagram.com/kftelkom" target="_blank">kftelkom</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Email -->
                </div>
            </div>
        
        </div>
    </section>
    <!-- End About Section -->
    
@endsection