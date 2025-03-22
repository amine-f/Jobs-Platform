<footer>
  <div class="footer-main">
    <div class="container">
      <div class="row">
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">For Job Seekers</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
             <a href="{{route('register')}}" class="footer-links">Register <span class="badge badge-primary">Free</span></a>
             <a href="{{route('login')}}" class="footer-links">Login</a>
             <a href="" class="footer-links">Find jobs</a>
             <a href="#" class="footer-links">Faq</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">For Employers</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
             <a href="{{route('register')}}" class="footer-links">Register <span class="badge badge-primary">Free</span></a>
             <a href="{{route('login')}}" class="footer-links">Login</a>
             <a href="{{route('post.create')}}" class="footer-links">Vacancy Announcement</a>
             <a href="#" class="footer-links">Faq</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h5 class="lead footer-hdr">Links</h5>
            <div class="line-divider"></div>
            <div class="footer-link-list">
             <a href="#" class="footer-links">Home</a>
             <a href="#" class="footer-links">About Us</a>
             <a href="#" class="footer-links">Advertise</a>
             <a href="#" class="footer-links">Contact Us</a>
             <a href="#" class="footer-links">Faq</a>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-md-3">
          <div class="footer-links">
            <h3 class="footer-brand mb-2">Job Gate By Welink Corp®</h3>
            <div class="footer-link-list">
             <a href="https://welink-corp.com/" target="_blank" class="footer-links"><i class="fas fa-compass"></i> Rue l’île de Rhodes, Immeuble Henda 1053 Les Berges du Lac 2</a>
             <a href="tel:98400001511" target="_blank" class="footer-links"><i class="fas fa-phone"></i> +216 23 022 100</a>
             <a href="tel:98400001511" target="_blank" class="footer-links"><i class="fas fa-mobile"></i> +216 51 923 094</a>
             <a href="mailto:info@joblister.com" target="_blank" class="footer-links"><i class="fas fa-envelope"></i> postmaster@welink-corp.com</a>
             <a href="https://welink-corp.com/" target="_blank" class="footer-links"><i class="fas fa-globe"></i> www.welink-corp.com</a>
             <div class="social-links">
               <a href="https://www.facebook.com/people/Welink-Corp/61564300022311/" target="_blank" class="social-link"><i class="fab fa-facebook"></i></a>
               <a href="https://www.instagram.com/welink_corp/"  target="_blank" class="social-link"><i class="fab fa-instagram"></i></a>
               <a href="https://www.linkedin.com/company/welink-corp/"  target="_blank" class="social-link"><i class="fab fa-linkedin" ></i></a>
               <a href="whatsapp://send?phone=21623022100&text=Bonjour%20%21%20Merci%20d%27avoir%20contact%C3%A9%20Welink%20corp.%20Comment%20pouvons-nous%20vous%20aider%20aujourd%27hui%20%3F"  target="_blank" class="social-link"><i class="fab fa-whatsapp" ></i></a>
             </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>

@push('css')
<style>
  .footer-main{
    background-color:#272727;
    color:#ddd;
  }
  .footer-links{
    padding-top:2rem;
    padding-bottom: 2rem;
  }
  .footer-links .footer-hdr{
    color:#ddd;
  }
  .footer-links .footer-link-list .footer-links{
    display:block;
    color:#ccc;
    padding:3px 0;
    margin:0;
    font-size:.9rem;
  }
  .footer-links .footer-link-list .footer-links:hover{
    color:white;
  }
  .footer-main .social-links {
    margin:20px 0;
  }
  .footer-main .social-links .social-link{
    background-color:white;
    color:#333;
    padding:8px 10px;
    border-radius: 50%;
    transition:all .3s ease;
  }
  .footer-main .social-links .social-link:hover{
    color:white;
    background-color:#0261A6;
  }
</style>
@endpush
