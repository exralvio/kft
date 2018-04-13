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
                        
                        <p class="text-justify mb-0">
                            <b>Photography will take you EVERYWHERE.</b> Photography dapat membawa kita kemana saja, membawa kita menjelajahi imajinasi tanpa batas. Komunitas Fotografi Telkom Group (KFT) hadir untuk memberi wadah bagi Telkom group untuk mendorong kreatifitas, memberi tempat bagi tumbuhnya imajinasi tanpa batas. KFT adalah mitra bagi Telkom Group untuk mendorong tumbuhnya budaya digital dan meningkatkan customer experience melalui digital photography. 
                        </p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="hs-line-11 font-alt mb-20 text-center hs-hr">Our Teams</h3>
            </div>
            
            <!-- Team -->
            <div class="row multi-columns-row about-team">
                <!-- Team Item -->
                <div class="col-sm-4 mb-md-30 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item">
                        
                        <div class="team-item-image">
                            
                            <img src="{{ url('images/team/team-irfan.jpg') }}" alt="" />
                            
                            <div class="team-item-detail">
                                <p>
                                    Email: irfan.tachrir@gmail.com<br>
                                    Facebook: Irfan A. Tachrir<br>
                                    Twitter: -<br>
                                    Instagram: irfantachrir<br>
                                    Website: -
                                </p>
                            </div>
                        </div>
                        



                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                IRFAN A TACHRIR
                            </div>
                            
                            <div class="team-item-role">
                                Pelindung
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
                                Pembina 1
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
                                Pembina 2
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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Email: arifrudiana@gmail.com<br>
                                    Facebook: N/A<br>
                                    Twitter: N/A<br>
                                    Instagram: arifrudiana<br>
                                    Website: www.photoblog.com/arifrudiana
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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Email: taufikzamzami@gmail.com<br>
                                    facebook: facebook.com/taufikz<br>
                                    Twitter: @taufikzamzami73<br>
                                    IG: taufikzamzami and taufikzamzami.daily<br>
                                    Website: N/A

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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Mail: icha7203@gmail.com<br>
                                    facebook: facebook.com/ichwanmuttaqin <br>
                                    Twitter: @icha7203<br>
                                    IG: icha7203<br>
                                    Website: N/A

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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Mail: romedly@gmail.com<br>
                                    facebook: facebook.com/romedly<br>
                                    Twitter: @romi_psyche<br>
                                    IG: romedly<br>
                                    Website: N/A
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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Email: nutrihadi@gmail.com<br>
                                    facebook: facebook.com/nutrihadi<br>
                                    Twitter: @Nutrihadi<br>
                                    IG: firdausnutrihadi<br>
                                    Website: N/A

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
                            
                            <div class="team-item-detail">
                                
                                <p>
                                    Email : bhiezoel@gmail.com<br>
                                    facebook :facebook.com/bhiezoel<br>
                                    twitter : @bhiezoel<br>
                                    ig : bhiezoel<br>
                                    website : N/A

                                </p>
                                
                            </div>
                        </div>
                        
                        <div class="team-item-descr font-alt">
                            
                            <div class="team-item-name">
                                BHIMO SULISTYO
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
                                Education &amp; Communication Dept
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <!-- End Team Item -->

                <div class="clearfix mb-50 mb-sm-10"></div>
                
                
                
            </div>
            <!-- End Team -->
            
        
        </div>
    </section>
    <!-- End About Section -->
    
@endsection