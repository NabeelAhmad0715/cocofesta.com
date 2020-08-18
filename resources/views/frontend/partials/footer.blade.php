<footer class="footer page-section-pt black-bg">
    <div class="container">
     <div class="row">
         <div class="col-lg-3 col-sm-4 sm-mb-30">
         <div class="footer-useful-link footer-hedding">
           <h6 class="text-white mb-30 mt-10 text-uppercase">Navigation</h6>
           <ul>
            <li><a href="{{ route('pages.home') }}">Home</a></li>
            <li><a href="{{ route('pages.about') }}">About</a></li>
            @if ($type)
              <li><a href="{{ route('pages.products',[$type->slug]) }}"> {{ $type->title }}</a>
              </li>
            @endif
              <li><a href="{{ route('pages.contact-us') }}">Contact Us</a></li>
           </ul>
         </div>
       </div>
       {{-- <div class="col-lg-2 col-sm-6 sm-mb-30">
         <div class="footer-useful-link footer-hedding">
           <h6 class="text-white mb-30 mt-10 text-uppercase">Useful Link</h6>
           <ul>
             <li><a href="#">Create Account</a></li>
             <li><a href="#">Company Philosophy</a></li>
             <li><a href="#">Corporate Culture</a></li>
             <li><a href="#">Portfolio</a></li>
             <li><a href="#">Client Management</a></li>
           </ul>
         </div>
       </div> --}}
       <div class="col-lg-5 col-sm-4 xs-mb-30">
       <h6 class="text-white mb-30 mt-10 text-uppercase">Contact Us</h6>
       <ul class="addresss-info">
           <li><i class="fa fa-map-marker"></i> <p>Address: 17504 Carlton Cuevas Rd, Gulfport, MS, 39503</p> </li>
           <li><i class="fa fa-phone"></i> <a href="tel:7042791249"> <span>+(704) 279-1249 </span> </a> </li>
           <li><i class="fa fa-envelope-o"></i>Email: <a href="mailto:contact@asfineleather.com">contact@asfineleather.com</a></li>
         </ul>
       </div>
       <div class="col-lg-4 col-sm-6">
         <h6 class="text-white mb-30 mt-10 text-uppercase">Subscribe to Our Newsletter</h6>
           <p class="mb-30">Sign Up to our Newsletter to get the latest news and offers.</p>
            <div class="footer-Newsletter">
             <div id="mc_embed_signup_scroll">
               <form action="php/mailchimp-action.php" method="POST" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate">
                <div id="msg"> </div>
                 <div id="mc_embed_signup_scroll_2">
                   <input id="mce-EMAIL" class="form-control" type="text" placeholder="Email address" name="email1" value="">
                 </div>
                 <div id="mce-responses" class="clear">
                   <div class="response" id="mce-error-response" style="display:none"></div>
                   <div class="response" id="mce-success-response" style="display:none"></div>
                   </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                   <div style="position: absolute; left: -5000px;" aria-hidden="true">
                       <input type="text" name="b_b7ef45306f8b17781aa5ae58a_6b09f39a55" tabindex="-1" value="">
                   </div>
                   <div class="clear">
                     <button type="submit" name="submitbtn" id="mc-embedded-subscribe" class="button button-border mt-20 form-button">  Get notified </button>
                   </div>
                 </form>
               </div>
               </div>
            </div>
          </div>
         <div class="footer-widget mt-20">
           <div class="row">
             <div class="col-lg-6 col-md-6">
              <p class="mt-15"> &copy;Copyright <span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="#"> As Fine Leather </a> All Rights Reserved </p>
             </div>
             <div class="col-lg-6 col-md-6 text-left text-md-right">
               <div class="social-icons color-hover mt-10">
                <ul>
                 <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                 <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                 <li class="social-youtube"><a href="#"><i class="fa fa-youtube"></i> </a></li>
                </ul>
              </div>
             </div>
           </div>
         </div>
     </div>
   </footer>
